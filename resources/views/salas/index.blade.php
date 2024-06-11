@extends('template.layout')

@section('titulo', 'Salas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Salas</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('salas.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar nova
            sala</a></p>
    <hr>
    <form method="GET" action="{{ route('salas.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="nome" id="inputNome"
                            value="{{ old('nome', $filterByNome) }}">
                        <label for="inputNome" class="form-label">Nome</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('salas.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Lugares</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salas as $sala)
                <tr>
                    <td>{{ $sala->nome }}</td>
                    <td>{{ $sala->lugares->count()}}</td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('salas.show', ['sala' => $sala]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('salas.edit', ['sala' => $sala]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('salas.destroy', ['sala' => $sala]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $salas->withQueryString()->links() }}
    </div>
@endsection
