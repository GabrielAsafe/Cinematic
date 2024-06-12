@extends('template.layout')

@section('titulo', 'Editar sessão')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item">Filmes</a></li>
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection

@section('main')
@include('sessoes.shared.table', [
            'sessoes' => $filme->sessoes,
            'v_filme' => $filme,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
            'showMenageSession' => false,
            'showEsgotada' => false
        ])
    <form method="POST" action="{{ route('filmes.sessao.store', ['filme' => $filme]) }}" enctype="multipart/form-data">
        @csrf
        @include('sessoes.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Editar sessão</button>
            <a href="{{ route('filmes.show', ['filme' => $filme]) }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
