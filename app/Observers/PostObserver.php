<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    public function creating(Post $post)
    {
        if(!\App::runningInConsole()) {
            $post->user_id = auth()->user()->id;
        }
    }

    public function deleting(Post $post)
    {
        // Si son las imagenes default no las elimino
        if(isset($post->image->url)) {
            if($post->image->url != 'posts/post-default-1.jpeg' &&
                $post->image->url != 'posts/post-default-2.jpeg' &&
                $post->image->url != 'posts/post-default-3.jpeg' &&
                $post->image->url != 'posts/post-default-4.jpeg' &&
                $post->image->url != 'posts/post-default-5.jpeg') {
                Storage::delete($post->image->url);
            }
        }
    }
}
