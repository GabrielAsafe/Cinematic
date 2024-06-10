@extends('template.layout')

@section('titulo', 'Filmes')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Filmes</li>
    </ol>
@endsection

@section('main')

    <form method="GET" action="{{ route('sessoes.validarBilhetes', ['sessao' =>session('valorSessao')]) }}">
        <div class="flex-grow-1 pe-2">
            <!-- Filtro por Bilhete -->
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1 mb-3 form-floating">
                    <input type="text" class="form-control" name="bilhete_id" id="inputBilheteId"
                           value="{{ old('bilhete_id', $filterByBilheteId) }}">
                    <label for="inputBilheteId" class="form-label">ID do Bilhete</label>
                </div>
            </div>
        </div>
        <div class="flex-shrink-1 d-flex flex-column justify-content-between">
            <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
            <a href="{{ route('sessoes.validarBilhetes', ['sessao' =>session('valorSessao') ]) }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>

        </div>
    </form>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>ID recibo</th>
            <th>ID cliente</th>
            <th>ID sessao</th>
            <th>ID lugar</th>
            <th>Estado</th>

            <th class="button-icon-col"></th>
            <th class="button-icon-col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($sessao as $recibo)
            <tr>

                <td>{{ $recibo->id }}</td>
                <td>{{ $recibo->recibo_id }}</td>
                <td>{{ $recibo->cliente_id }}</td>
                <td>{{ $recibo->sessao_id }}</td>
                <td>{{ $recibo->lugar_id }}</td>
                <td>{{ $recibo->estado }}</td>


                <td class="button-icon-col"><a class="btn btn-secondary"
                                               href="{{ route('sessoes.validarCliente', ['bilhetes' => $recibo]) }}">
                        <i class="fa fa-search"></i></a></td>

                <td class="button-icon-col"><a class="btn btn-secondary"
                                               href="{{ route('sessoes.permitirEntrada', ['bilhete' => $recibo]) }}">

                        <i class="fa fa-check"></i></a></td>


            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
