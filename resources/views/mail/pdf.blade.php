<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bilhete de Cinema</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ticket {
            max-width: 600px;
            margin: 30px auto;
            border: 1px dashed #333;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .ticket-header {
            text-align: center;
            border-bottom: 1px dashed #333;
            margin-bottom: 20px;
        }
        .ticket-details p {
            margin: 5px 0;
        }
        .ticket-details strong {
            display: inline-block;
            width: 150px;
        }
        .qrcode-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="ticket">
    <div class="d-flex align-items-center mb-3">
        <img src="{{ asset(Auth::user()->fullPhotoUrl) }}" alt="(Avatar)" class="bg-dark rounded-circle mr-3" width="45" height="45">

        <h5>{{ Auth::user()->name }}</h5>
    </div>
    <hr>
    <div class="ticket-header">
        <h2>Recibo da compra</h2>
    </div>
    <div class="ticket-details">
        <p><strong>Recibo ID:</strong> {{$recibo->id}}</p>
        <p><strong>Preço com IVA:</strong> {{$recibo->preco_total_sem_iva}}</p>
        <p><strong>IVA:</strong> {{$recibo->iva}}</p>
        <p><strong>Total com IVA:</strong> {{$recibo->preco_total_com_iva}}</p>
        <p><strong>NIF:</strong> {{$recibo->nif}}</p>
        <p><strong>Nome:</strong> {{$recibo->nome_cliente}}</p>
        <p><strong>Data:</strong> {{$recibo->data}}</p>
        <p><strong>Tipo de Pagamento:</strong> {{$recibo->tipo_pagamento}}</p>
        <p><strong>Referência de Pagamento:</strong> {{$recibo->ref_pagamento}}</p>
    </div>
    <h2>Bilhetes</h2>
    <div>
        <ul>
            <li><strong>Bilhete:</strong> {{$bilhete->id}}</li>
            <li><strong>Fila:</strong> {{$fila}}</li>
            <li><strong>Posição:</strong> {{$posicao}}</li>
            <li><strong>Nome da Sala:</strong> {{$nome_sala}}</li>
            <li><strong>Filme:</strong> {{$titulo}}</li>
            <li><strong>Hora de Início:</strong> {{$sessao->horario_inicio}}</li>
        </ul>
    </div>
    <div class="qrcode-container">
        <div class="qrcode-box">
            {!! $qrCode !!}
        </div>
    </div>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
