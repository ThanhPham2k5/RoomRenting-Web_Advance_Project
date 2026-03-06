<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayBill extends Model
{
    /** @use HasFactory<\Database\Factories\PayBillFactory> */
    use HasFactory;

    public function payRule(){
        return $this->belongsTo(PayRule::class);
    }

    public function saleDetails(){
        return $this->hasMany(SaleDetail::class);
    }
}
