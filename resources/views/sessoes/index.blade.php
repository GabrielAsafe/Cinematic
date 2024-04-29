<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title> <!--inserir uma variável para o nome do documento {{ '$zzzzz->classname' }}-->
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Filme Id</th>
        <th>Sala Id</th>
        <th>Data</th>
        <th>Hora Inicio</th>


        <th>Nº Semestres</th>
        <th>Nº Semestres</th>
        <th>Nº Semestres</th>

    </tr>
    </thead>
    <tbody>
    @foreach ($sessoes as $sessao)
        <tr>
            <td>{{ $sessao->filme_id }}</td>
            <td>{{ $sessao->sala_id }}</td>
            <td>{{ $sessao->data }}</td>
            <td>{{ $sessao->horario_inicio }}</td>


            <td><a href="{{route('bilhetes.index', ['sessao'=>$sessao])}}">Selecionar Sessões </a></td>
            <td><a href="{{route('filmes.show', ['filme'=>$sessao])}}">Consultar </a></td><!--não foi alterado-->

            <td>
                <a href="{{ route('filmes.edit', ['filme' => $sessao])   }}">editar</a><!--não foi alterado-->

            </td>


            <td>
                <form method="POST" action="{{ route('filmes.destroy', ['filme' => $sessao]) }}"><!--não foi alterado-->
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="delete">Apagar</button>
                </form>
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
