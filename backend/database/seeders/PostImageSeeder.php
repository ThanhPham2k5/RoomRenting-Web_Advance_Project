<?php

namespace Database\Seeders;

use App\Models\Posts\Post;
use App\Models\Posts\PostImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PostImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();

        foreach ($posts as $post) {

            // each post has 1 images
            $count = 1;

            for ($i = 1; $i <= $count; $i++) {
                PostImage::create([
                    'post_id' => $post->id,
                    'image_post_url' => $this->image($post->id, $i),
                    'order' => $i,
                ]);
            }
        }

    }

    // private function image()
    // {
    //     return collect([
    //         'https://images.unsplash.com/photo-1507089947368-19c1da9775ae',
    //         'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2',
    //         'https://images.unsplash.com/photo-1505691938895-1758d7feb511',
    //         'https://images.unsplash.com/photo-1484154218962-a197022b5858',
    //         'https://images.unsplash.com/photo-1493809842364-78817add7ffb',
    //         'https://images.unsplash.com/photo-1572120360610-d971b9b639c4',
    //     ])->random();
    // }

    private function image($postId, $order)
    {
        // fake image content
        $filename = "{$order}.jpg";

        $path = "posts/{$postId}/images/{$filename}";

        //get random image
        $response = Http::withoutVerifying()
        ->withOptions(['allow_redirects' => true]) 
        ->get("https://picsum.photos/seed/{$postId}/300");

        // create dummy file
        Storage::disk('public')->put($path, $response->body());

        return $path;
    }
}
