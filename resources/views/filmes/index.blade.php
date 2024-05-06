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
    <a href="#">cadastre-se ou faça Login</a> <!--loging do utilizador para podermos começar as validações-->

    <div class="container">
        <div class="row">
            <div class="col-4" style="border-style: solid;">
                <button onclick="location.href ='{{ route('filmes.create') }}'">Create new movie</button>
            </div>
            <div class="col-7" style="border-style: solid; margin-left: 10px;">
                <div class="container" style="padding-top: 20px;">
                    <div class="row">
                        @foreach ($filmes as $filme)
                            <div class="col-sm-4">
                                <div class="card" style="margin: 10px">
                                    <div class="card-header sensor" style="text-align:center;"> <a href="{{ route('filmes.show', ['filme' => $filme]) }}">{{ $filme->titulo }}</a></div>

                                    <div class="card-body" style="text-align:center;">
                                        <img src="cinematic/storage/app/public/cartazes/{{ $filme->cartaz_url }}" alt="{{ $filme->cartaz_url }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
