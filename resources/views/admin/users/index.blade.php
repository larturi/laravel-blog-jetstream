@extends('adminlte::page')

@section('title', 'Dashboard Blog')

@section('content_header')
    <h1>Listado de Usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')
@stop
