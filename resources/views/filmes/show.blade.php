@extends('template.layout')

@section('titulo', 'Filme')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('filmes.index') }}">Filmes</a></li>
        <li class="breadcrumb-item"><strong>{{ $filme->titulo }}</strong></li>
        <li class="breadcrumb-item active">Consultar</li>
    </ol>
@endsection

@section('main')
    <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
        <div class="flex-grow-1 pe-2">
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
            @include('filmes.shared.fields', [
                'filme' => $filme,
                'generos' => $generos,
                'readonlyData' => true,
            ])
            <div class="my-4 d-flex justify-content-end">
                <a href="{{ route('filmes.edit', ['filme' => $filme]) }}" class="btn btn-primary ms-3">Alterar Filme</a>
                <!--botão de alterar filme-->
            </div> 
        </div>
        <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
            style="min-width:260px; max-width:260px;">
            @include('filmes.shared.fields_cartazes', [
                'filme' => $filme,
                'allowUpload' => false,
                'allowDelete' => false,
            ])
        </div>
    </div> <!--Dados que veem da página anterior-->

    @php
        $showMenageSession = false;

        if (Auth::check() && Auth::user()->tipo == 'F') {
            $showMenageSession = true;
        }
    @endphp

    <div>
        <h3>Sessões</h3>
        @include('sessoes.shared.table', [
            'sessoes' => $filme->sessoes,
            'v_filme' => $filme,
            'showDetail' => true,
            'showEdit' => true,
            'showDelete' => true,
            'showMenageSession' => $showMenageSession,
            'showEsgotada' => true,
            'showSelect' => false
        ])
        </div>

    @endsection
