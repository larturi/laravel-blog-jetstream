<div class="form-group">
    {!! Form::label('name', 'Rol') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Rol']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('roles', 'Listado de Permisos') !!}
    @foreach ($permissions as $permission)
        <div>
        <label>
                {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                {{ $permission->description }}
        </label>
        </div>
    @endforeach
</div>
