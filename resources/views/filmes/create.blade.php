<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form action="{{ route('filmes.store') }}" method="post">
        @csrf
        <div>
            <label for="inputNome">Titulo</label>
            <input type="text" name="titulo" id="inputTitulo" value="{{ old('titulo') }}">
            @error('titulo')
            <em>{{ $message }}</em>
            @enderror
        </div>
        <div>
            <label for="inputGenero">Genero</label>
            <select id="inputGenero" name="genero_code">
                @foreach ($generos as $genero)
                    <option value="{{ $genero->code }}">{{ $genero->code }}</option>
                @endforeach
            </select>
            @error('genero_code')
            <em>{{ $message }}</em>
            @enderror
        </div>
        <div>
            <label for="inputAno">Ano</label>
            <input type="text" name="ano" id="inputAno" value="{{ old('ano') }}">
            @error('ano')
            <em>{{ $message }}</em>
            @enderror
        </div>
        <div>
            <label for="inputCartaz">Cartaz URL</label>
            <input type="text" name="cartaz_url" id="inputCartaz" value="{{ old('cartaz_url') }}">
            @error('cartaz_url')
            <em>{{ $message }}</em>
            @enderror
        </div>
        <div>
            <label for="inputSumario">Sumario</label>
            <textarea name="sumario" id="inputSumario" rows=10>{{ old('sumario') }}</textarea>
            @error('sumario')
            <em>{{ $message }}</em>
            @enderror
        </div>
        <div>
            <label for="inputTrailer">Trailer</label>
            <input type="text" name="trailer_url" id="inputTrailer" value="{{ old('trailer_url') }}">
            @error('trailer_url')
            <em>{{ $message }}</em>
            @enderror
        </div>
        <div>
            <button type="submit" name="ok">Guardar novo curso</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
