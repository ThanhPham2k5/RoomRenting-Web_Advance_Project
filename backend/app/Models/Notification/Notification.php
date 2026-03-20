<?php

namespace App\Models\Notification;

use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = ['title', 'content', 'notification_type', 'account_id', 'notifiable_type', 'notifiable_id', 'status'];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function notifiable(){ 
        return $this->morphTo();
    }

    protected static function newFactory()
    {
        return \Database\Factories\NotificationFactory::new();
    }
}
