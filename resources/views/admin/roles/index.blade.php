@extends('adminlte::page')

@section('title', 'Dashboard Blog')

@section('content_header')
    @can('admin.categories.create')
        <a href="{{ route('admin.roles.create') }}" class="btn btn-secondary btn-sm float-right">Nuevo Rol</a>
    @endcan
    <h1>Listado de Roles</h1>
@stop

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td width="10px">
                                @can('admin.roles.edit')                                    
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.roles.destroy')
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
