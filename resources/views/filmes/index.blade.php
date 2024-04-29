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
<a href="#">cadastre-se ou faça Login</a> <!--loging do utilizador para podermos começar as validações-->

<br><br>
<table>
    <thead>
    <tr>
        <th>Abreviatura</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Nº Semestres</th>
        <th>Nº Semestres</th>

        <th>Nº Semestres</th>
        <th>Nº Semestres</th>
        <th>Nº Semestres</th>

    </tr>
    </thead>
    <tbody>
    @foreach ($filmes as $filme)
        <tr>
            <td>{{ $filme->id }}</td>
            <td>{{ $filme->titulo }}</td>
            <td>{{ $filme->genero_code }}</td>
            <td>{{ $filme->ano }}</td>
            <td>{{ $filme->cartaz_url }}</td>
            <td>{{ $filme->custom }}</td>


            <td><a href="{{route('sessoes.index', ['filme'=>$filme->id])}}">Buscar Sessões </a></td> <!--mando um payload contendo os dados do filme-->
            <td><a href="{{route('filmes.show', ['filme'=>$filme])}}">Consultar </a></td> <!--não foi alterado-->

            <td>
                <a href="{{ route('filmes.edit', ['filme' => $filme])   }}">editar</a><!--não foi alterado-->

            </td>


            <td>
                <form method="POST" action="{{ route('filmes.destroy', ['filme' => $filme]) }}"><!--não foi alterado-->
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
