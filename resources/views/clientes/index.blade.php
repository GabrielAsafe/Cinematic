@extends('template.layout')

@section('titulo', 'Clientes')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Usuários</li>
        <li class="breadcrumb-item active">Clientes</li>
    </ol>
@endsection

@section('main')
    <form method="GET" action="{{ route('clientes.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="estado" id="inputEstado">
                            <option {{ old('estado', $filterByEstado) == 0 ? 'selected' : '' }} value=0 >
                                Desbloqueado</option>
                            <option {{ old('estado', $filterByEstado) == 1 ? 'selected' : '' }} value=1 > Bloqueado
                            </option>
                        </select>
                        <label for="inputEstado" class="form-label">Estado</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="name" id="inputNome"
                            value="{{ old('name', $filterByNome) }}">
                        <label for="inputNome" class="form-label">Nome</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>
    @include('clientes.shared.table', [
        'clientes' => $clientes,
        'showFoto' => true,
        'showDetail' => true,
        'showEdit' => false,
        'showDelete' => true,
        'showBlock' => true,
    ])
    <div>
        {{ $clientes->withQueryString()->links() }}
    </div>
@endsection
