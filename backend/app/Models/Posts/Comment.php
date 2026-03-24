<?php

namespace App\Models\Posts;

use App\Models\Account_User\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['content', 'post_id', 'account_id'];

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
