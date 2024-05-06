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
    <div>
        <label for="inputNome">Titulo</label>
        <input type="text" name="titulo" id="inputTitulo" value="{{ $filme->nome }}">
    </div>
    <div>
        <label for="inputGenero">Genero</label>
        <select id="inputCurso" name="curso">
            @foreach ( $generos as $genero )
            <option value="{{  $genero->abreviatura  }}">{{  $curso->abreviatura  }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="inputSemestres">Semestres</label>
        <input type="text" name="semestres" id="inputSemestres" {{ $disableStr }} value="{{ $curso->semestres }}">
    </div>
    <div>
        <label for="inputECTS">ECTS</label>
        <input type="text" name="ECTS" id="inputECTS" {{ $disableStr }} value="{{ $curso->ECTS }}">
    </div>
    <div>
        <label for="inputVagas">Vagas</label>
        <input type="text" name="vagas" id="inputVagas" {{ $disableStr }} value="{{ $curso->vagas }}">
    </div>
    <div>
        <label for="inputContato">Contato</label>
        <input type="text" name="contato" id="inputContato" {{ $disableStr }} value="{{ $curso->contato }}">
    </div>
    <div>
        <label for="inputObjetivos">Objetivos</label>
        <textarea name="objetivos" id="inputObjetivos" {{ $disableStr }} rows=10>{{ $curso->objetivos }}
     </textarea>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
