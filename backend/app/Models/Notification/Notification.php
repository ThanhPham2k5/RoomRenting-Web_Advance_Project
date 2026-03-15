<?php

namespace App\Models\Notification;

use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

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
