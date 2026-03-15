<?php

namespace App\Models\Posts;

use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\CommentFactory::new();
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }
}
