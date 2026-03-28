<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RechargeRule extends Model
{
    /** @use HasFactory<\Database\Factories\RechargeRuleFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['points', 'money'];

    protected static function newFactory()
    {
        return \Database\Factories\RechargeRuleFactory::new();
    }

    public function rechargeBills(){
        return $this->hasMany(RechargeBill::class);
    }
}
