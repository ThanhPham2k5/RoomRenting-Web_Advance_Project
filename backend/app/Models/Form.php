<?php

namespace App\Models;

use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    /** @use HasFactory<\Database\Factories\FormFactory> */
    use HasFactory;
    protected $fillable = ['price_max', 'price_min', 'area', 'ward', 'province', 'room_type', 'max_occupants', 'account_id'];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
