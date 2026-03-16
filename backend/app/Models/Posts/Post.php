<?php

namespace App\Models\Posts;

use App\Models\Account_User\Account;
use App\Models\Account_User\Employee;
use App\Models\Account_User\User;
use App\Models\Notification\Notification;
use App\Models\Payments\PayBill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'description', 'price', 'area', 'house_number', 'ward', 'province', 'deposit', 'status', 'authorized', 'user_id', 'employee_id', 'room_type', 'max_occupants'];

    protected static function newFactory()
    {
        return \Database\Factories\PostFactory::new();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function postImages(){
        return $this->hasMany(PostImage::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function notifications(){
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function payBills(){
        return $this->hasMany(PayBill::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
