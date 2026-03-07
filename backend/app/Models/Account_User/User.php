<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    public function personalInfo(){
        return $this->belongsTo(PersonalInfo::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
