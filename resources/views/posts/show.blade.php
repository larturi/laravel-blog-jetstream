<x-app-layout>

    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{ $post->name }}</h1>

        <div class="text-lg text-gray-500 mb-4 mt-2">
            {!! $post->extract !!}
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Contenido principal -->
            <div class="md:col-span-2">
                <figure>
                    <img class="w-full h-80 object-cover object-center" src="@if($post->image) {{Storage::url($post->image->url)}} @else {{config('constants.DEFAULT_IMAGE_POST')}} @endif" alt="">
                </figure>

                <div class="mt-4 text-base text-gray-500">
                    {!! $post->body !!}
                </div>
            </div>

            <!-- Posts relacionados -->
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Más en {{ $post->category->name }}</h1>

                <ul>
                    @foreach ($relacionados as $relacionado)
                        <li class="mb-4">
                            <a class="flex" href="{{ route('posts.show', $relacionado) }}" class="text-lg text-gray-500 hover:text-gray-700">
                               <img class="w-36 h-20 object-cover object-center" src="@if($relacionado->image) {{Storage::url($relacionado->image->url) }} @else {{config('constants.DEFAULT_IMAGE_POST')}} @endif" alt="">
                               <span class="ml-3 text-gray-600 w-60">{{ $relacionado->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </div>

</x-app-layout>