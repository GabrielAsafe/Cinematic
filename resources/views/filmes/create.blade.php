
@extends('template.layout')

@section('titulo', 'Novo Filme')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('filmes.index') }}">Filmes</a></li>
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('filmes.store') }}">
        @csrf
        @include('filmes.shared')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar novo filme</button>
            <a href="{{ route('filmes.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
