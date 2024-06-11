@extends('template.layout')

@section('titulo', 'Salas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('salas.index') }}">Salas</a></li>
        <li class="breadcrumb-item">{{ $sala->nome }}</li>
        <li class="breadcrumb-item active">Consultar</li>
        <td class="button-icon-col">
    </ol>
@endsection
@section('main')
    <div>

        @include('salas.shared.fields', [
            'sala' => $sala,
            'readonlyData' => true,
        ])

        <div class="my-4 d-flex justify-content-end">
            <a href="{{ route('salas.edit', ['sala' => $sala]) }}" class="btn btn-secondary ms-3">Alterar Sala</a>
        </div>
    </div>
    <div>
        @include('lugares.shared.table', [
            'lugares' => $sala->lugares,
            'showDetail' => false,
            'showEdit' => false,
            'showDelete' => false,
            'showAddCart' => false,
        ])
    </div>
@endsection
