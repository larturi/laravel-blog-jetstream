<div class="card">

    <div class="card-header">
        <input wire:model="search" type="text" class="form-control" placeholder="Buscar por nombre del Post...">
    </div>

    @if ($posts->count() > 0)
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->name }}</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm mr-2">Editar</a>
                        
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @method('DELETE')
                                    @csrf()
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @else

    <div class="card-body">
        <p class="text-center">No hay registros</p>
    </div>
    @endif
</div>
