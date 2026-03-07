<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    /** @use HasFactory<\Database\Factories\PostImageFactory> */
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\PostImageFactory::new();
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
