<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

use Illuminate\Support\Facades\Cache;
class PostController extends Controller
{
    public function index() {

        if(request()->page) {
            $key = 'posts' . request()->page;
        } else {
            $key = 'posts';
        }

        if (Cache::has($key)) {
            $posts = Cache::get($key);
        } else {
            $posts = Post::where('status', config('constants.STATUS_POST.PUBLISHED'))->latest('id')->paginate(8);
            Cache::put($key, $posts);
        }
        
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post) {
        $this->authorize('isPublished', $post);
        $relacionados = Post::where('status', config('constants.STATUS_POST.PUBLISHED'))
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

    public function tag(Tag $tag) {
        $posts = $tag->posts()->where('status', config('constants.STATUS_POST.PUBLISHED'))->latest('id')->paginate(4);
        return view('posts.tag', compact('posts', 'tag'));
    }
}
