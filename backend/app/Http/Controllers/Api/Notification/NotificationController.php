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
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class NotificationController extends Controller
{

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
        
        $post = Post::findOrFail($request->post_id);

        $notification = new Notification($validated);
        $notification->notifiable()->associate($post);

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
