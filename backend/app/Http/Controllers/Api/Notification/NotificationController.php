<?php

namespace App\Http\Controllers\Api\Notification;

use App\Filter\NotificationFilter;
use App\Models\Notification\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Payments\Paybill;
use App\Models\Payments\Rechargebill;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{
    use AuthorizesRequests;
    private $allowedIncludes = [
        'account',
        'notifiable'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Notification::class)
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::partial('title'),
            AllowedFilter::partial('content'),
            AllowedFilter::operator('status', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::operator('notificationType', FilterOperator::DYNAMIC, '', 'notification_type'), // =, <>
            AllowedFilter::partial('notifiableType', 'notifiable_type'),
        ])
        ->allowedSorts([
            'id',
        ]);

        $perPage = $request->per_page ?? 15;

        if ($perPage === 'all') {
            $Notifications = $query->get();
        } else {
            $Notifications = $query->paginate((int) $perPage)
                ->appends($request->query());
        }

        return new NotificationCollection($Notifications);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        $validated = $request->validated();
        // Based on the input variable to determine
        if (!empty($request['post_id'])) {
            $model = Post::findOrFail($request['post_id']);
        } elseif (!empty($request['paybill_id'])) {
            $model = Paybill::findOrFail($request['paybill_id']);
        } elseif (!empty($request['rechargebill_id'])) {
            $model = Rechargebill::findOrFail($request['rechargebill_id']);
        } else {
            return response()->json(['message' => 'Missing target'], 400);
        }
        $validated['status'] = 'unread';
        $notification = new Notification($validated);
        $notification->notifiable()->associate($model);

        $notification->save();

        return response()->json([
            'message' => 'Notification created successfully',
            'notification' => new NotificationResource($notification)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);

        $notification = QueryBuilder::for(Notification::class)
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($notification->id);

        return new NotificationResource($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        $this->authorize('update', $notification);

        $validated = $request->validated();

        // nếu có post_id thì cập nhật quan hệ polymorphic
        if ($request->post_id) {
            $post = Post::findOrFail($request->post_id);
            $notification->notifiable()->associate($post);
        }

        $notification->update($validated);

        return response()->json([
            'message' => 'Notification updated successfully',
            'notification' => new NotificationResource($notification)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);

        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully'
        ]);
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update(['status' => 'read']);

        return response()->json([
            'message' => 'Notification marked as read',
            'notification' => new NotificationResource($notification)
        ]);
    }
}
