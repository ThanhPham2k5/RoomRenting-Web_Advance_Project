<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;
    protected $fillable = ['post_id', 'account_id'];

    protected static function newFactory()
    {
        return \Database\Factories\FavoriteFactory::new();
    }

    // public function favoritePosts(){
    //     return $this->belongsToMany(Post::class, 'favorite');
    // }

    // public function favoriteBy(){
    //     return $this->belongsToMany(Account::class, 'favorite');
    // }
}
