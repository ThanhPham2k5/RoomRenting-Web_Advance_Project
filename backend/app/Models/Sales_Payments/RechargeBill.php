<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeBill extends Model
{
    /** @use HasFactory<\Database\Factories\RechargeBillFactory> */
    use HasFactory;

    public function rechargeRule(){
        return $this->belongsTo(RechargeRule::class);
    }

    public function saleDetails(){
        return $this->hasMany(SaleDetail::class);
    }
}
