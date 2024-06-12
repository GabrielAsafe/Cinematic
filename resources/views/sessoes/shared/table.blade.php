<table class="table" style="width: 83%">
    <thead class="table-dark">
        <tr>
            <th>Sala</th>
            <th>Data</th>
            <th>Horario Inicio</th>
            @if ($showSelect)
            <th>Selecionar Sessão a Editar</th>
            <th class="button-icon-col"></th>
            @endif
            @if ($showEsgotada)
            <th>Estado</th>
            <th class="button-icon-col"></th>
            @endif
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
            @if ($showSelect)
            <td> <!-- Button to fill input with session ID -->
                <button type="button" class="btn btn-primary fill-session-id" data-session-id="{{ $sessao->id }}">
                    Selecionar
                </button>
            </td>
            @endif
            @if ($showEsgotada)
            @if ($sessao->bilhetes->count() == $sessao->salaRef->lugares->count())
            <td>
                <p>Esgotado &#x2714;</p>
            </td>
            @else
            <td>
                <p>Não Esgotado &#x2716;</p>
            </td>
            @endif
            @endif
            @if ($showDetail && $sessao->bilhetes->count() != $sessao->salaRef->lugares->count())
            <td class="button-icon-col"><a class="btn btn-secondary" href="{{ route('sessoes.getLugaresVazios', ['sessaoId' => $sessao]) }}">
                    <i class="fas fa-eye"></i></a></td>
            @endif
            @if ($showMenageSession)
            <td class="button-icon-col"><a class="btn btn-dark" href="{{ route('sessoes.validarBilhetes', ['sessao' => $sessao->id]) }}">
                    <i class="fa fa-address-card"></i></a></td>
            @endif

            @if ($showEdit)
            <td class="button-icon-col"><a class="btn btn-dark" href="{{ route('filmes.sessao.update', ['filme' => $filme]) }}">
                    <i class="fas fa-edit"></i></a></td>
            @endif
            <!--essa linha não vai ser executara pois em filmes.show essa variável está a false-->
            @if ($showDelete)
            <td class="button-icon-col">
                <form method="POST" action="{{ route('filmes.sessao.destroy', ['filme' => $filme, 'sessao' => $sessao]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="delete" class="btn btn-danger">
                        <i class="fas fa-trash"></i></button>
                </form>
            </td>
            @endif

        </tr>
        @endforeach
    </tbody>
</table>