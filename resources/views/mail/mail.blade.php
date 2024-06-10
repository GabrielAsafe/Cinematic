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
        <h2>Recibo da compra</h2>
    </div>
    <div class="ticket-details">
        <p><strong>Recibo ID:</strong> {{$bilhetes[0]->id}}</p>
        <p><strong>Preço com IVA:</strong> {{$bilhetes[0]->preco_total_sem_iva}}</p>
        <p><strong>IVA:</strong> {{$bilhetes[0]->iva}}</p>
        <p><strong>Total com IVA:</strong> {{$bilhetes[0]->preco_total_com_iva}}</p>
        <p><strong>NIF:</strong> {{$bilhetes[0]->nif}}</p>
        <p><strong>Nome:</strong> {{$bilhetes[0]->nome_cliente}}</p>
        <p><strong>Data:</strong> {{$bilhetes[0]->data}}</p>
        <p><strong>Tipo de Pagamento:</strong> {{$bilhetes[0]->tipo_pagamento}}</p>
        <p><strong>Referência de Pagamento:</strong> {{$bilhetes[0]->ref_pagamento}}</p>
    </div>

    <div class="ticket-header">
        <h2>Bilhetes</h2>
    </div>
    <div class="container mt-5">
        @for ($i = 1; $i < count($bilhetes); $i++)
            <div class="card mb-3">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Recibo ID:</strong> {{$bilhetes[$i]->recibo_id}}</li>
                        <li><strong>Cliente ID:</strong> {{$bilhetes[$i]->cliente_id}}</li>
                        <li><strong>Sessão ID:</strong> {{$bilhetes[$i]->sessao_id}}</li>
                        <li><strong>Lugar ID:</strong> {{$bilhetes[$i]->lugar_id}}</li>
                        <li><strong>Preço sem IVA:</strong> {{$bilhetes[$i]->preco_sem_iva}}</li>
                        <li><strong>Estado:</strong> {{$bilhetes[$i]->estado}}</li>
                        <li><strong>Bilhete ID:</strong> {{$bilhetes[$i]->id}}</li>
                    </ul>
                </div>
            </div>
        @endfor
    </div>
</div>





<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



