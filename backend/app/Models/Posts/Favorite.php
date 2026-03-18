<?php

namespace App\Models\Posts;

use App\Models\Account_User\Account;
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

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
