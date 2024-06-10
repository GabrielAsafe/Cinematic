@extends('template.layout')

@section('titulo', 'Novo Funcionario')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('funcionarios.index') }}">Funcionarios</a></li>
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection

@section('main')
    <form id="form_funcionario" method="POST" action="{{ route('funcionarios.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('users.shared.fields', ['user' => $funcionario, 'readonlyData' => false])
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_funcionario">Guardar novo
                        funcionario</button>
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('users.shared.fields_foto', [
                    'user' => $funcionario,
                    'allowUpload' => true,
                    'allowDelete' => false,
                ])
            </div>
        </div>
    </form>
@endsection
