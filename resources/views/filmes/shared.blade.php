<div>
    <label for="inputNome">Titulo</label>
    <input type="text" name="titulo" id="inputTitulo" value="{{old('titulo', $filme->titulo)}}">
    @error('titulo')
    <em>{{ $message }}</em>
    @enderror
</div>
<div>
    <label for="inputGenero">Genero</label>
    <select id="inputGenero" name="genero_code">
        @foreach ($generos as $genero)
            <option value="{{ $genero->code }}" {{ $filme->genero_code == $genero->code ? 'selected' : '' }}>{{ $genero->code }}</option>
        @endforeach
    </select>
    @error('genero_code')
    <em>{{ $message }}</em>
    @enderror
</div>
<div>
    <label for="inputAno">Ano</label>
    <input type="text" name="ano" id="inputAno" value="{{ $filme->ano }}">
    @error('ano')
    <em>{{ $message }}</em>
    @enderror
</div>
<div>
    <label for="inputCartaz">Cartaz URL</label>
    <input type="text" name="cartaz_url" id="inputCartaz" value="{{ $filme->cartaz_url }}">
    @error('cartaz_url')
    <em>{{ $message }}</em>
    @enderror
</div>
<div>
    <label for="inputSumario">Sumario</label>
    <textarea name="sumario" id="inputSumario" rows=10>{{ $filme->sumario }}</textarea>
    @error('sumario')
    <em>{{ $message }}</em>
    @enderror
</div>
<div>
    <label for="inputTrailer">Trailer</label>
    <input type="text" name="trailer_url" id="inputTrailer" value="{{ $filme->trailer_url }}">
    @error('trailer_url')
    <em>{{ $message }}</em>
    @enderror
</div>

