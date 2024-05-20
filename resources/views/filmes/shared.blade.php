<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="inputTitulo"
        value="{{ old('titulo', $filme->titulo) }}">
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
        value="{{ old('ano', $filme->ano) }}">
    <label for="inputAno" class="form-label">Ano</label>
    @error('ano')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('cartaz_url') is-invalid @enderror" name="cartaz_url"
        id="inputcartaz" value="{{ old('cartaz_url', $filme->cartaz_url) }}">
    <label for="inputcartaz" class="form-label">Cartaz URL</label>
    @error('cartaz_url')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('sumario') is-invalid @enderror" name="sumario" id="inputsumario"
        value="{{ old('sumario', $filme->sumario) }}">
    <label for="inputsumario" class="form-label">Sumario</label>
    @error('sumario')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('trailer_url') is-invalid @enderror" name="trailer_url"
        id="inputtrailer" value="{{ old('trailer_url', $filme->trailer_url) }}">
    <label for="inputtrailer" class="form-label">Trailer URL</label>
    @error('trailer_url')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>