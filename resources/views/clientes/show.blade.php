@extends('template.layout')

@section('titulo', 'Cliente')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Usuários</li>
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li class="breadcrumb-item"><strong>{{ $cliente->user->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $cliente->user, 'readonlyData' => true])
                @include('clientes.shared.fields', ['cliente' => $cliente, 'readonlyData' => true])
                <div class="my-1 d-flex justify-content-end">
                    @can('delete', $cliente)
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal">
                        Apagar cliente
                    </button>
                    @endcan
                    @can('update', $cliente)
                    <a href="{{ route('clientes.edit', ['cliente' => $cliente]) }}" class="btn btn-secondary ms-3">
                        Alterar Perfil
                    </a>
                    @endcan
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $cliente->user,
                    'allowUpload' => false,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </div>
    @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar o cliente?',
        'msgLine1' => 'Clique no botão "Apagar" para confirmar a operação',
        'msgLine2' => '',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'clientes.destroy',
        'formActionRouteParameters' => ['cliente' => $cliente],
        'formMethod' => 'DELETE',
    ])
@endsection
