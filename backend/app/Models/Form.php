<?php

namespace App\Models;

use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    /** @use HasFactory<\Database\Factories\FormFactory> */
    use HasFactory;

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
