<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Sala</th>
            <th>Data</th>
            <th>Horario Inicio</th>
            <th>Estado</th>
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showEdit)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif


            @if ($showMenageSession ?? false)
                <th class="button-icon-col"></th>
            @endif
        </tr>

    </thead>
    <tbody>
        @foreach ($sessoes as $sessao)
            <tr>
                <td>{{ $sessao->salaRef->nome }}</td>
                <td>{{ $sessao->data }}</td>
                <td>{{ $sessao->horario_inicio }}</td>
                @if ($sessao->bilhetes->count() == $sessao->salaRef->lugares->count())
                    <td>
                        <p>Esgotado</p>
                    </td>
                @else
                    <td>
                        <p>Não Esgotado</p>
                    </td>
                @endif
                @if ($showDetail && $sessao->bilhetes->count() != $sessao->salaRef->lugares->count())
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('sessoes.getLugaresVazios', ['sessaoId' => $sessao]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showMenageSession)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('sessoes.validarBilhetes', ['sessao' => $sessao->id]) }}">
                            <i class="fa fa-address-card"></i></a></td>
                @endif

                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('sessoes.edit', ['sessao' => $sessao]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                <!--essa linha não vai ser executara pois em filmes.show essa variável está a false-->
                @if ($showDelete)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('sessoes.destroy', ['sessao' => $sessao]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                @endif
                <!--essa linha não vai ser executara pois em filmes.show essa variável está a false-->

            </tr>
        @endforeach
    </tbody>
</table>
