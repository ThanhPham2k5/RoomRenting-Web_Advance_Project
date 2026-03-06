<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

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

    public function favoriteBy(){
        return $this->belongsToMany(Account::class, 'favorite');
    }
}
