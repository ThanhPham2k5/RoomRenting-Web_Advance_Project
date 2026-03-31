<?php
namespace App\Services;

use App\Filter\AllColumnFilter;
use App\Filter\DateFilter;
use App\Http\Resources\NotificationResource;
use App\Models\Notification\Notification;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

class NotificationService{
    private $allowedIncludes = [
        'account',
        'notifiable'
    ];

    private $allColFilter = [
        'title',
        'content',
        'status',
        'notificationType' => 'notification_type',
        'notifiableType' => 'notifiable_type',
    ];

    public function buildGetAllQuery(){
        $query = QueryBuilder::for(Notification::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->allowedFilters([
            //generic search
            AllowedFilter::custom('search', new AllColumnFilter($this->allColFilter)),

            //specific filters
            AllowedFilter::exact('id'),
            AllowedFilter::exact('account.id'),
            AllowedFilter::partial('title'),
            AllowedFilter::partial('content'),
            AllowedFilter::operator('status', FilterOperator::DYNAMIC), // =, <>
            AllowedFilter::exact('notificationType', 'notification_type'),
            // AllowedFilter::operator('notificationType', FilterOperator::DYNAMIC, 'notification_type'), // =, <>
            AllowedFilter::partial('notifiableType', 'notifiable_type'),
            AllowedFilter::custom('createdAt', new DateFilter(), 'created_at'),
        ])
        ->allowedSorts([
            'id',
            AllowedSort::field('createdAt', 'created_at'),
        ]);

        return $query;
    }

    public function getNotification($notification){
        $notification = QueryBuilder::for(Notification::withTrashed())
        ->allowedIncludes($this->allowedIncludes)
        ->findOrFail($notification->id);

        return $notification;
    }

    public function createNotification($data, $model){

        $data['status'] = 'unread';
        $notification = new Notification($data);
        $notification->notifiable()->associate($model);

        $notification->save();

        return [
            'message' => 'Notification created successfully',
            'notification' => new NotificationResource($notification)
        ];
    }

    public function updateNotification($data, $notification){
        $notification->update($data);

        return [
            'message' => 'Notification updated successfully',
            'notification' => new NotificationResource($notification)
        ];
    }

    public function deleteNotification($notification){
        $notification->delete();

        return [
            'message' => 'Notification deleted successfully'
        ];
    }

    public function restoreNotification($id){
        $noti = Notification::onlyTrashed()->findOrFail($id);

        $noti->restore();

        return [
            'message' => 'Notification restored successfully',
            'notification'    => new NotificationResource($noti),
        ];
    }
}
?>