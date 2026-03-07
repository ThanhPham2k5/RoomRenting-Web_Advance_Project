<?php

namespace App\Models;

use App\Http\Controllers\PayBillController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayRule extends Model
{
    /** @use HasFactory<\Database\Factories\PayRuleFactory> */
    use HasFactory, SoftDeletes;

    public function payBills(){
        return $this->hasMany(PayBill::class);
    }
}
