@extends('adminlte::page')

@section('title', 'Dashboard Blog')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body col-12 col-md-9">
            {!! Form::model($user, [
                'route' => ['admin.users.update', $user], 
                'autocomplete' => 'off', 
                'method' => 'put',
                ]) 
            !!}

                @include('admin.users.partials.form', compact('roles'))

                {!! Form::submit('Actualizar Usuario', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop


@section('css')
@stop

@section('js')
@endsection