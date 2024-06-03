@extends('template.layout')

@section('titulo', 'Filme')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('filmes.index') }}">Filmes</a></li>
        <li class="breadcrumb-item"><strong>{{ $filme->titulo }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div>
        <div class="mb-3 form-floating">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="{{ $filme->trailer_url }}" allowfullscreen></iframe>
            </div>
            @error('trailer_url')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 form-floating">
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="inputTitulo"
                disabled value="{{ old('titulo', $filme->titulo) }}">
            <label for="inputAbr" class="form-label">Titulo</label>
            @error('titulo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 form-floating">
            <select class="form-control @error('genero_code') is-invalid @enderror" name="genero_code" id="inputgenero"
                disabled>
                @foreach ($generos as $genero)
                    <option {{ $genero->code == old('genero_code', $filme->genero_code) ? 'selected' : '' }}
                        value="{{ $genero->code }}">
                        {{ $genero->nome }}</option>
                @endforeach
            </select>
            <label for="inputCurso" class="form-label">Genero</label>
            @error('genero_code')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 form-floating">
            <input type="text" class="form-control @error('ano') is-invalid @enderror" name="ano" id="inputAno"
                disabled value="{{ old('ano', $filme->ano) }}">
            <label for="inputAno" class="form-label">Ano</label>
            @error('ano')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 form-floating">
            <input type="text" class="form-control @error('sumario') is-invalid @enderror" name="sumario"
                id="inputsumario" disabled value="{{ old('sumario', $filme->sumario) }}">
            <label for="inputsumario" class="form-label">Sumario</label>
            @error('sumario')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> <!--Dados que veem da página anterior-->

    <div class="my-4 d-flex justify-content-end">
        <a href="{{ route('filmes.edit', ['filme' => $filme]) }}" class="btn btn-secondary ms-3">Alterar Filme</a>

    </div> <!--botão de alterar filme-->
    <div class="btn btn-success">
        <a href="{{ route('filmes.sessao.create', ['filme' => $filme]) }}" class="btn btn-secondary ms-3">Criar sessao</a>
    </div> 


    <div>
        <h3>Sessões</h3>
        @include('sessoes.shared.table', [
            'sessoes' => $filme->sessoes,
            'v_filme' => $filme,
            'showDetail' => true,
            'showEdit' => false,
            'showDelete' => false,
        ])
@endsection