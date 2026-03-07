<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
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
