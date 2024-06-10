<table class="table">
    <thead class="table-dark">
        <tr>
            @if ($showFoto)
                <th></th>
            @endif
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
        @foreach ($admins as $admin)
            <tr>
                @if ($showFoto)
                    <td width="45">
                        @if ($admin->fullPhotoUrl)
                            <img src="{{ $admin->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle"
                                width="45" height="45">
                        @endif
                    </td>
                @endif
                <td>{{ $admin->name }}</td>
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('admins.show', ['admin' => $admin]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('admins.edit', ['admin' => $admin]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                @if ($showDelete)
                <td class="button-icon-col">
                    <form method="POST" action="{{ route('admins.destroy', ['admin' => $admin]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="delete" class="btn btn-danger">
                            <i class="fas fa-trash"></i></button>
                    </form>
                </td>
                @endif
                <td class="button-icon-col">
                    <form method="POST" action="{{ route('admins.admin.block', ['admin' => $admin]) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="block" class="btn btn-warning">
                            <i class="fas fa-ban"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


