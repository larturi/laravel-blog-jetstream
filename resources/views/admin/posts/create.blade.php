@extends('adminlte::page')

@section('title', 'Dashboard Blog')

@section('content_header')
    <h1>Crear Post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body col-12 col-md-9">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}

                {!! Form::hidden('user_id', auth()->user()->id) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug', 'readonly' => 'readonly']) !!}

                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Category') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select Category']) !!}

                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <p class="font-weight-bold">Labels</p>
                    @foreach ($tags as $tag)
                        <label class="mr-2">
                            {!! Form::checkbox('tags[]', $tag->id, null) !!}
                            {{ $tag->name }}
                        </label>
                    @endforeach

                    @error('tags')
                        <br>
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <p class="font-weight-bold">Estado</p>
                    <label class="mr-2">
                        {!! Form::radio('status', config('constants.STATUS_POST.PENDING'), true) !!} 
                        Borrador
                    </label>

                    <label>
                        {!! Form::radio('status', config('constants.STATUS_POST.PUBLISHED')) !!} 
                        Publicado
                    </label>

                    @error('status')
                        <br>
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <div class="image-wrapper">
                            <img id="picture" src="{{ config('constants.DEFAULT_IMAGE_POST') }}" alt="">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('file', 'Imagen principal') !!}
                            {!! Form::file('file', ['class' => 'form-control-file', 'images/*']) !!}

                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum odit delectus distinctio eum numquam soluta expedita est reprehenderit vero quo?</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('extract', 'Extracto') !!}
                    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

                    @error('extract')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Cuerpo del post') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {!! Form::submit('Crear Post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25% 
        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('vendor/jquery-string-to-slug/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });

        ClassicEditor
            .create( document.querySelector( '#extract' ))
            .catch( error => {
                console.error( error );
            });

        ClassicEditor
            .create( document.querySelector( '#body' ))
            .catch( error => {
                console.error( error );
            });

        // Imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);
        
        function cambiarImagen(event){
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
             };
            reader.readAsDataURL(file);
        }

    </script>
@endsection