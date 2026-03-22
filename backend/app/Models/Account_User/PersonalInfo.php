<?php

namespace App\Models\Account_User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    /** @use HasFactory<\Database\Factories\PersonalInfoFactory> */
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\PersonalInfoFactory::new();
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'house_number',
        'ward',
        'province',
        'email',
        'phone_number',
        'pid'
    ];

}
