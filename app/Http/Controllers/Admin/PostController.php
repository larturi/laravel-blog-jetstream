<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
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


    public function store(StorePostRequest $request)
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
        return view('admin.posts.edit', compact('post'));

    }


    public function update(Request $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        //
    }
}
