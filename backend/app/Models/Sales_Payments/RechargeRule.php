<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeRule extends Model
{
    /** @use HasFactory<\Database\Factories\RechargeRuleFactory> */
    use HasFactory;

    public function rechargeBills(){
        return $this->hasMany(RechargeBill::class);
    }
}
