<?php

namespace App\Http\Controllers\Api\Notification;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Models\Notification\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use App\Models\Account_User\Account;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Payments\Paybill;
use App\Models\Payments\Rechargebill;
use App\Services\NotificationService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NotificationController extends Controller
{
    use AuthorizesRequests;

    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->notificationService->buildGetAllQuery();

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

        $result = $this->notificationService->createNotification($validated, $model);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);

        $notification = $this->notificationService->getNotification($notification);

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

        $result = $this->notificationService->updateNotification($validated, $notification);

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);

        $result = $this->notificationService->deleteNotification($notification);

        return response()->json($result);
    }

    public function restore($id) {

        $result = $this->notificationService->restoreNotification($id);

        return response()->json($result);
    }
}
