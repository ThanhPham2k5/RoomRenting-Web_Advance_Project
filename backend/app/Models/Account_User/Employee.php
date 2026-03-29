<?php

namespace App\Models\Account_User;

use App\Models\Notification\Notification;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory, SoftDeletes;

    protected static function newFactory()
    {
        return \Database\Factories\EmployeeFactory::new();
    }

    public function personalInfo(){
        return $this->belongsTo(PersonalInfo::class);
    }


    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    protected $fillable = [
        'account_id',
        'personal_info_id'
    ];
}
