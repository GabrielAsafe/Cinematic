<table class="table">
    <thead class="table-dark">
        <tr>
            @if ($showFoto)
                <th></th>
            @endif
            <th>Nif</th>
            <th>Nome</th>
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showEdit)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                @if ($showFoto)
                    <td width="45">
                        @if ($cliente->user->fullPhotoUrl)
                            <img src="{{ $cliente->user->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                        @endif
                    </td>
                @endif
                <td>{{ $cliente->nif }}</td>
                <td>{{ $cliente->user->name }}</td>
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('clientes.show', ['cliente' => $cliente]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('clientes.edit', ['cliente' => $cliente]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                @if ($showDelete)
                    <td class="button-icon-col">
                        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal">
                            <i class="fas fa-trash"></i></button>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
