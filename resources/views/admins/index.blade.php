@extends('template.layout')

@section('titulo', 'admins')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">admins</li>
    </ol>
@endsection

@section('main')
    <form method="GET" action="{{ route('admins.index') }}">
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
                <a href="{{ route('admins.index') }}"
                    class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>
    <p><a class="btn btn-success" href="{{ route('admins.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar novo
            administrador</a></p>
    @include('admins.shared.table', [
        'admins' => $admins,
        'showFoto' => true,
        'showDetail' => true,
        'showEdit' => true,
        'showDelete' => true,
    ])
    <div>
        {{ $admins->withQueryString()->links() }}
    </div>
@endsection
