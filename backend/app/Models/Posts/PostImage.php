<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{
    /** @use HasFactory<\Database\Factories\PostImageFactory> */
    use HasFactory, SoftDeletes;
        protected $fillable = ['post_id', 'image_post_url', 'order'];

    protected static function newFactory()
    {
        return \Database\Factories\PostImageFactory::new();
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
