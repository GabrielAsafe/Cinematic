@extends('template.layout')

@section('titulo', 'Alterar Sala')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('salas.index') }}">Salas</a></li>
        <li class="breadcrumb-item"><strong>{{ $sala->nome }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form id="form_sala" novalidate class="needs-validation" method="POST"
        action="{{ route('salas.update', ['sala' => $sala]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">

                @include('salas.shared.fields', [
                    'filme' => $sala,
                    'readonlyData' => false,
                ])

                <div class="my-1 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary" name="ok" id="form_sala">Guardar
                        Alterações</button>
                    <a href="{{ route('salas.index', ['sala' => $sala]) }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
        </div>
        <div>
            <div class="my-1 d-flex justify-content-end">
                <a href="{{ route('lugares.create', ['sala_id' => $sala->id]) }}" class="btn btn-secondary ms-3">Criar
                    Lugares</a>
            </div>
            @include('lugares.shared.table', [
                'lugares' => $sala->lugares,
                'showDetail' => false,
                'showEdit' => false,
                'showDelete' => false,
                'showAddCart' => false,
            ])
        </div>
    </form>
@endsection
