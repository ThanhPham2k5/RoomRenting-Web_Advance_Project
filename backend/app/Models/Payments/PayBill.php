<?php

namespace App\Models\Payments;

use App\Models\Account_User\Account;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayBill extends Model
{
    /** @use HasFactory<\Database\Factories\PayBillFactory> */
    use HasFactory;
    protected $fillable = ['account_id', 'pay_rule_id', 'post_id', 'status', 'points'];

    protected static function newFactory()
    {
        return \Database\Factories\PayBillFactory::new();
    }

    public function payRule(){
        return $this->belongsTo(PayRule::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

}
