<?php

namespace App\Models\Payments;

use App\Http\Controllers\PayBillController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayRule extends Model
{
    /** @use HasFactory<\Database\Factories\PayRuleFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['points', 'status'];

        protected static function newFactory()
    {
        return \Database\Factories\PayRuleFactory::new();
    }

    public function payBills(){
        return $this->hasMany(PayBill::class);
    }
}
