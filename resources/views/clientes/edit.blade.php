@extends('template.layout')

@section('titulo', 'Alterar cliente')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">clientes</a></li>
        <li class="breadcrumb-item"><strong>{{ $cliente->user->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form id="form_cliente" novalidate class="needs-validation" method="POST"
        action="{{ route('clientes.update', ['cliente' => $cliente]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $cliente->user_id }}">
        <input type="hidden" name="id" value="{{ $cliente->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $cliente->user, 'readonlyData' => false])
                @include('clientes.shared.fields', ['cliente' => $cliente, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_cliente">Guardar
                        Alterações</button>
                    <a href="{{ route('clientes.show', ['cliente' => $cliente]) }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $cliente->user,
                    'allowUpload' => true,
                    'allowDelete' => true,
                ])
            </div>
        </div>
    </form>´
    @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar a foto?',
        'msgLine1' => 'As alterações efetuadas ao dados do docente vão ser perdidas!',
        'msgLine2' => 'Clique no botão "Apagar" para confirmar a operação.',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'clientes.foto.destroy',
        'formActionRouteParameters' => ['cliente' => $cliente],
        'formMethod' => 'DELETE',
    ])
@endsection
