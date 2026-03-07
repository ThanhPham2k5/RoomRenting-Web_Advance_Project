<?php

namespace App\Models\Payments;

use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeBill extends Model
{
    /** @use HasFactory<\Database\Factories\RechargeBillFactory> */
    use HasFactory;

    public function rechargeRule(){
        return $this->belongsTo(RechargeRule::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
