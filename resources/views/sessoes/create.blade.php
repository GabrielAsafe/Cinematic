@extends('template.layout')

@section('titulo', 'Nova sessão')

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
            'showDetail' => false,
            'showEdit' => false,
            'showDelete' => false,
        ])
    <form method="POST" action="{{ route('filmes.sessao.store', ['filme' => $filme]) }}" enctype="multipart/form-data">
        @csrf
        @include('sessoes.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar nova sessão</button>
            <a href="{{ route('filmes.show', ['filme' => $filme]) }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
