@extends('adminlte::page')

@section('title', 'Dashboard Blog')

@section('content_header')
    <div class="row">
        <div class="col-9">
            <h1>Listado de Posts</h1>
        </div>
        <div class="col-3">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-secondary float-right">Nuevo Post</a>
        </div>
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    
    @livewire('admin.post-index')
@stop

@section('js')
@stop