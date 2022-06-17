<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::where('status', 1)->latest('id')->paginate(8);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post) {
        $relacionados = Post::where('status', 1)
                        ->where('category_id', '=', $post->category_id)
                        ->where('id', '!=', $post->id)
                        ->latest('id')->take(4)->get();
        return view('posts.show', compact('post', 'relacionados'));
    }

    public function category(Category $category) {
        $posts = Post::where('status', 1)
                        ->where('category_id', '=', $category->id)
                        ->latest('id')->paginate(4);

        return view('posts.category', compact('posts', 'category'));
    }
}
