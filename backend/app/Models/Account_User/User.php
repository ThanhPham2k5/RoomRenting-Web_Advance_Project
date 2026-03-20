<?php

namespace App\Models\Account_User;

use App\Models\Notification\Notification;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;


    protected static function newFactory()
    {
        return \Database\Factories\UserFactory::new();
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
}
