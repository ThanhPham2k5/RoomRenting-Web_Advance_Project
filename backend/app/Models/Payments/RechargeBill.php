<?php

namespace App\Models\Payments;

use App\Models\Account_User\Account;
use App\Models\Notification\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RechargeBill extends Model
{
    /** @use HasFactory<\Database\Factories\RechargeBillFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['money', 'total_money', 'vat', 'status', 'recharge_rule_id', 'account_id', 'points'];

    protected static function newFactory()
    {
        return \Database\Factories\RechargeBillFactory::new();
    }

    public function rechargeRule(){
        return $this->belongsTo(RechargeRule::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
