<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        return view('admin.posts.index');
    }


    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }


    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        if($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            $post->image()->create([
                'url' => $url,
            ]);
        }

        if($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post);
    }


    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        $this->authorize('isAuthor', $post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }


    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('isAuthor', $post);

        // Update Post
        $post->update($request->all());

        // Update Image
        if($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            if($post->image) {

                // Si son las imagenes default no las elimino
                if($post->image->url != 'posts/post-default-1.jpeg' &&
                    $post->image->url != 'posts/post-default-2.jpeg' &&
                    $post->image->url != 'posts/post-default-3.jpeg' &&
                    $post->image->url != 'posts/post-default-4.jpeg' &&
                    $post->image->url != 'posts/post-default-5.jpeg') {
                    Storage::delete($post->image->url);
                }

                $post->image->update([
                    'url' => $url
                ]);
            } else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        // Update Tags
        if($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post fue actualizado con exito');
    }


    public function destroy(Post $post)
    {
        $this->authorize('isAuthor', $post);
        
        $post->delete();
        return redirect()->route('admin.posts.index', $post)->with('info', 'El post fue eliminado con exito');
    }
}
