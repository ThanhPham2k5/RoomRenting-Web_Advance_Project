<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory, SoftDeletes;

    public function form(){
        return $this->hasOne(Form::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function employee(){
        return $this->hasOne(Employee::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function favoritePosts(){
        return $this->belongsToMany(Post::class, 'favorite');
    } 

    public function rechargeBills(){
        return $this->hasMany(RechargeBill::class);
    }

    public function payBills(){
        return $this->hasMany(PayBill::class);
    }
}
