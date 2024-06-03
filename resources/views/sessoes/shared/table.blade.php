<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Sala</th>
            <th>Data</th>
            <th>Horario Inicio</th>
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
       @foreach ($sessoes as $sessao)
            <tr>
                <td>{{ $sessao->sala_id }}</td>
                <td>{{ $sessao->data }}</td>
                <td>{{ $sessao->horario_inicio }}</td>

                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"

                            href="{{ route('sessoes.getLugaresVazios', ['sessaoId' => $sessao]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('sessoes.edit', ['sessao' => $sessao]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif <!--essa linha não vai ser executara pois em filmes.show essa variável está a false-->
                @if ($showDelete)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('sessoes.destroy', ['sessao' => $sessao]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                @endif <!--essa linha não vai ser executara pois em filmes.show essa variável está a false-->

            </tr>
        @endforeach
    </tbody>
</table>
