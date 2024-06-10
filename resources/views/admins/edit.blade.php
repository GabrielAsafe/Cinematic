@extends('template.layout')

@section('titulo', 'Alterar admin')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">admins</a></li>
        <li class="breadcrumb-item"><strong>{{ $admin->name }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form id="form_admin" novalidate class="needs-validation" method="POST"
        action="{{ route('admins.update', ['admin' => $admin]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $admin->id }}">
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $admin, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_admin">Guardar
                        Alterações</button>
                    <a href="{{ route('admins.show', ['admin' => $admin]) }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $admin,
                    'allowUpload' => true,
                    'allowDelete' => true,
                ])
            </div>
        </div>
    </form>
    @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar a foto?',
        'msgLine1' => 'As alterações efetuadas ao dados do docente vão ser perdidas!',
        'msgLine2' => 'Clique no botão "Apagar" para confirmar a operação.',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'admins.foto.destroy',
        'formActionRouteParameters' => ['admin' => $admin],
        'formMethod' => 'DELETE',
    ])
@endsection
