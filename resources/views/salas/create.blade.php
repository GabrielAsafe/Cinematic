@extends('template.layout')

@section('titulo', 'Nova Sala')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('salas.index') }}">Salas</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('salas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('salas.shared.fields', [
                    'sala' => $sala,
                    'readonlyData' => false,
                ])
                <div class="mb-3 form-floating">
                    <input type="number" class="form-control @error('quantidade') is-invalid @enderror" name="quantidade"
                        id="inputQuantidade" value="0">
                    <label for="inputQuantidade" class="form-label">Quantidade de Lugares</label>
                    @error('quantidade')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="my-1 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary" name="ok">Guardar nova sala</button>
                    <a href="{{ route('salas.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
@endsection
