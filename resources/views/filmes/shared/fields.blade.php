@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="inputTitulo"
    {{ $disabledStr }} value="{{ old('titulo', $filme->titulo) }}">
    <label for="inputAbr" class="form-label">Titulo</label>
    @error('titulo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <select class="form-control @error('genero_code') is-invalid @enderror" name="genero_code" id="inputgenero">
        @foreach ($generos as $genero)
            <option {{ $genero->code == old('genero_code', $filme->genero_code) ? 'selected' : '' }}
                {{ $disabledStr }} value="{{ $genero->code }}">
                {{ $genero->nome }}</option>
        @endforeach
    </select>
    <label for="inputgenero" class="form-label">Genero</label>
    @error('genero_code')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('ano') is-invalid @enderror" name="ano" id="inputAno"
    {{ $disabledStr }} value="{{ old('ano', $filme->ano) }}">
    <label for="inputAno" class="form-label">Ano</label>
    @error('ano')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('sumario') is-invalid @enderror" name="sumario" id="inputsumario"
    {{ $disabledStr }}value="{{ old('sumario', $filme->sumario) }}">
    <label for="inputsumario" class="form-label">Sumario</label>
    @error('sumario')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('trailer_url') is-invalid @enderror" name="trailer_url"
        id="inputtrailer" {{ $disabledStr }}value="{{ old('trailer_url', $filme->trailer_url) }}">
    <label for="inputtrailer" class="form-label">Trailer URL</label>
    @error('trailer_url')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
