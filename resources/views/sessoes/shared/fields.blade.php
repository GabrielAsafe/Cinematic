<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" id="inputTitulo"
        value="{{ old('titulo', $filme->titulo) }}" disabled>
    <label for="inputAbr" class="form-label">Titulo</label>
    @error('titulo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <select class="form-control @error('salas_id') is-invalid @enderror" name="sala_id" id="inputsalas">
        @foreach ($salas as $sala)
            <option {{ $sala->code == old('salas_id', $filme->salas_id) ? 'selected' : '' }}
                value="{{ $sala->id }}">
                {{ $sala->nome }}</option>
        @endforeach
    </select>
    <label for="inputCurso" class="form-label">Salas</label>
    @error('sala_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="date" min="2015-01-01T00:00" max="2030-12-31T23:59" step="1" class="form-control @error('data') is-invalid @enderror" name="data" id="datainput">
    <label class="form-label">Data</label>
    @error('data')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="mb-3 form-floating">
    <input type="time" class="form-control @error('horario_inicio') is-invalid @enderror" step="1"name="horario_inicio" id="horario_inicio">
    <label class="form-label">Horario de Início</label>
    @error('horario_inicio')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div><!--
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
-->