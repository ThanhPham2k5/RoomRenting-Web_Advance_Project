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
        $Notifications = QueryBuilder::for(Notification::class)
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
        ])
        ->paginate()
        ->appends($request->query());

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
