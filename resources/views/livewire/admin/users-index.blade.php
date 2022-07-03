<div class="card">

    <div class="card-header">
        <input wire:model="search" type="text" class="form-control" placeholder="Buscar...">
    </div>

    @if ($users->count() > 0)
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm mr-2">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            <p class="text-center">No hay registros</p>
        </div>
    @endif
</div>
