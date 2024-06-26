@extends('template.layout')

@section('titulo', 'Lugares')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('filmes.index') }}">Filmes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('filmes.show', ['filme' => $filme]) }}">{{ $filme->titulo }}</a></li>
        <li class="breadcrumb-item"><strong>{{ $sesso->sala_id }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
        <td class="button-icon-col">

    </ol>
@endsection

@section('main')
<div>
    @include('lugares.shared.table', [
        'lugares' => $lugaresVazios,
        'lugaresVazios' =>$lugaresVazios,
        'showDetail' => false,
        'showEdit' => false,
        'showDelete' => false,
        'showAddCart' => true, //TODO editei aqui e tem que alterar a breadcrumb
    ])
</div>
@endsection

<?php
session()->put('v_filme', $filme);
session()->put('v_sessao', $sesso);
?>
