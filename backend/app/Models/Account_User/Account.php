<?php

namespace App\Models\Account_User;

use App\Models\Form;
use App\Models\Payments\PayBill;
use App\Models\Payments\RechargeBill;
use App\Models\Posts\Comment;
use App\Models\Posts\Favorite;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory, SoftDeletes, HasApiTokens, HasRoles;
    protected $fillable = ['username', 'password', 'role'];
    protected $guard_name = 'api';

    protected static function newFactory()
    {
        return \Database\Factories\AccountFactory::new();
    }

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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function rechargeBills(){
        return $this->hasMany(RechargeBill::class);
    }

    public function payBills(){
        return $this->hasMany(PayBill::class);
    }
}
