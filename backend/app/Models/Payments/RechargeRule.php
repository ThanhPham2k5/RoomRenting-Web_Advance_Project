<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RechargeRule extends Model
{
    /** @use HasFactory<\Database\Factories\RechargeRuleFactory> */
    use HasFactory, SoftDeletes;

    public function rechargeBills(){
        return $this->hasMany(RechargeBill::class);
    }
}
