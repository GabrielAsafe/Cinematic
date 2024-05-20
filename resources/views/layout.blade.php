<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
                   maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ESTG</title>
    @vite(['resources/sass/app.scss'])
</head>

<body>
    <nav>
        <ul>
            <li>
                <a href="{{ route('cursos.index') }}">Cursos</a>
            </li>
            <li>
                <a href="{{ route('disciplinas.index') }}">Disciplinas</a>
            </li>
        </ul>
    </nav>
    <div class="main">
        <header>
            <h1>@yield('header-title')</h1>
        </header>
        <div class="content">
            @yield('main')
        </div>
    </div>
</body>

</html>