@extends('template.layout')

@section('titulo', 'Alterar Sala')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('configuracao.index') }}">Configuração</a></li>
        <li class="breadcrumb-item"><strong>{{ $configuracao->id }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form id="form" novalidate class="needs-validation" method="POST"
          action="{{ route('configuracao.update', ['configuracao' => $configuracao]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="mb-3 form-floating">
            <input type="text" class="form-control @error('preco_bilhete_sem_iva') is-invalid @enderror" name="preco_bilhete_sem_iva" id="inputpreco_bilhete_sem_iva"
                   value="{{ old('preco_bilhete_sem_iva', $configuracao->preco_bilhete_sem_iva) }}">
            <label for="inputAbr" class="form-label">preco_bilhete_sem_iva</label>
            @error('preco_bilhete_sem_iva')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3 form-floating">
            <input type="text" class="form-control @error('percentagem_iva') is-invalid @enderror" name="percentagem_iva" id="inputpercentagem_iva"
                value="{{ old('percentagem_iva', $configuracao->percentagem_iva) }}">
            <label for="inputAbr" class="form-label">percentagem_iva</label>
            @error('percentagem_iva')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                <div class="my-1 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary" name="ok" id="form">Guardar
                        Alterações</button>
                    <a href="{{ route('configuracao.index', ['configuracao' => $configuracao]) }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
        </div>



    </form>
@endsection
