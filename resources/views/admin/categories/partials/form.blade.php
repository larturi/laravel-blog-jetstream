<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoría']) !!}

    @error('name')
        <span class="text-danger text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Slug de la categoría', 'readonly']) !!}

    @error('slug')
    <span class="text-danger text-sm">{{ $message }}</span>
    @enderror
</div>