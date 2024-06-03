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
    <form method="POST" action="{{ route('filmes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('filmes.shared.fields', [
                    'filme' => $filme,
                    'generos' => $generos,
                    'readonlyData' => false,
                ])
            </div>

            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('filmes.shared.fields_cartazes', [
                    'filme' => $filme,
                    'allowUpload' => true,
                    'allowDelete' => true,
                ])
            </div>
        </div>
        <div class="my-4 d-flex justify-content-start">
            <button type="submit" class="btn btn-primary" name="ok">Guardar novo filme</button>
            <a href="{{ route('filmes.create') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
@endsection
