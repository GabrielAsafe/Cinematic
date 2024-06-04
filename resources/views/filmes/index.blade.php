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
    <p><a class="btn btn-success" href="{{ route('filmes.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar novo
            filmes</a></p>
    <hr>
    <form method="GET" action="{{ route('filmes.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="genero_code" id="inputGenero">
                            <option {{ old('genero_code', $filterByGenero) === '' ? 'selected' : '' }} value="">Todos
                                Generos </option>
                            @foreach ($generos as $genero)
                                <option {{ old('genero_code', $filterByGenero) == $genero->code ? 'selected' : '' }}
                                    value="{{ $genero->code }}">{{ $genero->nome }}</option>
                            @endforeach
                        </select>
                        <label for="inputGenero" class="form-label">Genero</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="titulo" id="inputTitulo"
                            value="{{ old('titulo', $filterByTitulo) }}">
                        <label for="inputTitulo" class="form-label">Titulo</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="sumario" id="inputSumario"
                               value="{{ old('sumario', $filterbySumario) }}">
                        <label for="sumario" class="form-label">Sumário</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('filmes.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Cartaz</th>
                <th>Titulo</th>
                <th>Genero</th>
                <th>Ano</th>
                <th>Sumario</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filmes as $filme)
                <tr>
                    <td width="45">
                        @if ($filme->cartaz_url)
                            <img src="{{ $filme->fullCartazUrl }}" alt="{{ $filme->cartaz_url }}" width="45"
                                height="45">
                        @endif
                    </td>
                    <td>{{ $filme->titulo }}</td>
                    <td>{{ $filme->generoRef->nome }}</td>
                    <td>{{ $filme->ano }}</td>
                    <td>{{ $filme->sumario }}</td>

                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('filmes.show', ['filme' => $filme]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('filmes.edit', ['filme' => $filme]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmationModal">
                            <i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (isset($filme))
        @include('shared.confirmationDialog', [
            'title' => 'Quer realmente apagar o filme?',
            'msgLine1' => 'Clique no botão "Apagar" para confirmar a operação',
            'msgLine2' => '',
            'confirmationButton' => 'Apagar',
            'formActionRoute' => 'filmes.destroy',
            'formActionRouteParameters' => ['filme' => $filme],
            'formMethod' => 'DELETE',
        ])
    @endif

    <div>
        {{ $filmes->withQueryString()->links() }}
    </div>
@endsection
