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
    </style>
</head>
<body>
<div class="ticket">
    <div class="ticket-header">
        <h2>Bilhete de Cinema</h2>
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
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



