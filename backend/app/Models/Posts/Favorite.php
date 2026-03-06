<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;

    // public function favoritePosts(){
    //     return $this->belongsToMany(Post::class, 'favorite');
    // }

    // public function favoriteBy(){
    //     return $this->belongsToMany(Account::class, 'favorite');
    // }
}
