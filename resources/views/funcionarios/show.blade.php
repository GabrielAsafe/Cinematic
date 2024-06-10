@extends('template.layout')

@section('titulo', 'funcionario')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('funcionarios.index') }}">funcionarios</a></li>
        <li class="breadcrumb-item"><strong>{{ $funcionario->name }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $funcionario, 'readonlyData' => true])
                <div class="my-1 d-flex justify-content-end">
                    <button type="button" name="delete" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmationModal">
                        Apagar funcionario
                    </button>
                    <a href="{{ route('funcionarios.edit', ['funcionario' => $funcionario]) }}" class="btn btn-secondary ms-3">
                        Alterar funcionario
                    </a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $funcionario,
                    'allowUpload' => false,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </div>
    @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar o funcionario?',
        'msgLine1' => 'Clique no botão "Apagar" para confirmar a operação',
        'msgLine2' => '',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'funcionarios.destroy',
        'formActionRouteParameters' => ['funcionario' => $funcionario],
        'formMethod' => 'DELETE',
    ])
@endsection
