@extends('template.layout')

@section('titulo', 'Nova Sala')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('salas.index') }}">Salas</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('lugares.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                <input type="hidden" name="sala_id" value="{{ $sala_id }}">
                <div class="mb-3 form-floating">
                    <select class="form-select @error('fila') is-invalid @enderror" name="fila" id="inputFila">
                        <option value="">Selecione uma fila</option>
                        @for ($i = 65; $i <= 90; $i++)
                            <option value="{{ chr($i) }}" {{ old('fila') == chr($i) ? 'selected' : '' }}>
                                {{ chr($i) }}</option>
                        @endfor
                    </select>
                    <label for="inputFila" class="form-label">Fila</label>
                    @error('fila')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 form-floating">
                    <select class="form-select @error('posicao') is-invalid @enderror" name="posicao" id="inputPosicao">
                        <option value="">Selecione uma posição</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ old('posicao') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                    <label for="inputPosicao" class="form-label">Posição</label>
                    @error('posicao')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="my-1 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary" name="ok">Guardar novo lugar</button>
                    <a href="{{ route('salas.edit', ['sala' => $sala_id]) }}" class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
        </div>
    </form>
@endsection
