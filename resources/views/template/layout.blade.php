<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cinematic</title>


    @vite('resources/sass/app.scss')
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand " href="{{ route('home') }}">
            <img src="/img/logo.png" alt="Logo" class="bg-dark" width="140" height="52">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        @guest
        <ul class="navbar-nav ms-auto me-1 me-lg-3">
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </li>
            @endif
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            </li>
            @endif
        </ul>
        @else
        <div class="ms-auto me-0 me-md-2 my-2 my-md-0 navbar-text">
            {{ Auth::user()->name }}
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav me-1 me-lg-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->fullPhotoUrl }}" alt="Avatar" class="rounded-circle" width="45" height="45">
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if ((Auth::user()->tipo ?? '') == 'C')
                    <li><a class="dropdown-item" href="{{ route('clientes.show', ['cliente' => Auth::user()->cliente]) }}">Perfil</a>
                    </li>
                    @endif
                    <li><a class="dropdown-item" href="{{ route('password.change.show') }}">Alterar Senha</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        @endguest
    </nav> <!-- merdas do loging-->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link {{ Route::currentRouteName() == 'filmes.index' ? 'active' : '' }}" href="{{ route('filmes.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Filmes
                        </a>

                        <!-- essa parte deveria aparecer para funcionários/administração -->

                        @if (Auth::check() && Auth::user()->tipo == 'A')
                        <div class="sb-sidenav-menu-heading">Gestão</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCurricular" aria-expanded="false" aria-controls="collapseCurricular">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Utilizadores
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCurricular" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ Route::currentRouteName() == 'clientes.index' ? 'active' : '' }}" href="{{ route('clientes.index') }}">Clientes</a>
                                <a class="nav-link {{ Route::currentRouteName() == 'clientes.index' ? 'active' : '' }}" href="{{ route('funcionarios.index') }}">Funcionários</a>
                                <a class="nav-link {{ Route::currentRouteName() == 'clientes.index' ? 'active' : '' }}" href="{{ route('admins.index') }}">Admins</a>
                            </nav>
                        </div>
                        <a class="nav-link {{ Route::currentRouteName() == 'salas.index' ? 'active' : '' }}" href="{{ route('salas.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                            Salas
                        </a>


                        <a class="nav-link {{ Route::currentRouteName() == 'configuracao.index' ? 'active' : '' }}" href="{{ route('configuracao.index') }}">
                            <div class="sb-nav-link-icon"><i class="fab fa-amazon-pay"></i></div>
                            Preço bilhete
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'estatisticas.index' ? 'active' : '' }}" href="{{ route('estatisticas.index') }}">
                            <div class="sb-nav-link-icon"><i class="fab fa-amazon-pay"></i></div>
                            Estatísticas
                        </a>
                        @endif
                        <!-- essa parte deveria aparecer para todos-->

                        <div class="sb-sidenav-menu-heading font-weight-bold">Espaço Privado</div>
                        <a class="nav-link {{ Route::currentRouteName() == 'bilhetes.index' ? 'active' : '' }}" href="{{ route('bilhetes.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-text"></i></div>
                            Meus Bilhetes
                        </a>


                        <a class="nav-link {{ Route::currentRouteName() == 'cart.show' ? 'active' : '' }}" href="{{ route('cart.show') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>Carrinho
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @if (session('alert-msg'))
                    @include('partials.messages')
                    @endif
                    @if ($errors->any())
                    @include('shared.alertValidation')
                    @endif
                    <h1 class="mt-4">@yield('titulo', 'Cinematic')</h1>
                    @yield('subtitulo')
                    <div class="mt-4">
                        @yield('main')
                    </div>
                </div>
            </main>
            <footer class="py-2 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy;Cinematic</div>
                    </div>
                </div>
            </footer>
        </div>
    </div> <!-- merdas da barra lateral -->

    @vite('resources/js/app.js')
</body>

</html>