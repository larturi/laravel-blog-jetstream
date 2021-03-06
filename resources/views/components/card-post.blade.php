@props(['post'])

<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
    <img class="w-full h-72 object-cover object-center" src="@if($post->image) {{Storage::url($post->image->url)}} @else {{config('constants.DEFAULT_IMAGE_POST')}} @endif" alt="">

    <div class="py-4 px-6">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
        </h1>

        <div class="text-gray-700 text-base">
            {!! $post->extract !!}
        </div>
    </div>

    <div class="px-6 mb-4">
        @foreach ($post->tags as $tag)
        <a href="{{ route('posts.tag', $tag) }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm gray-color-700 mr-2">
            {{ $tag->name }}
        </a>
        @endforeach
    </div>
</article>