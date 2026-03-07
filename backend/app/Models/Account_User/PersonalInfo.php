<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    /** @use HasFactory<\Database\Factories\PersonalInfoFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'house_number',
        'ward',
        'province',
        'phone_number',
        'pid'
    ];

}
