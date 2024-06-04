<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <div class="col-md-12">
            <p><strong>Recibo ID:</strong>{{$recibo->id}} </p>
            <p><strong>Preço com iva:</strong>{{$recibo->preco_total_sem_iva}}</p>
            <p><strong>IVA:</strong>{{$recibo->iva}} </p>
            <p><strong>Total com iva:</strong>{{$recibo->preco_total_com_iva}} </p>
            <p><strong>Nif:</strong>{{$recibo->nif}}</p>
            <p><strong>Nome:</strong>{{$recibo->nome_cliente}} </p>
            <p><strong>Data:</strong>{{$recibo->data}} </p>
            <p><strong>Tipo pagamento:</strong>{{$recibo->tipo_pagamento}} </p>
            <p><strong>Referência de pagamento :</strong>{{$recibo->ref_pagamento}}</p>
        </div>

    </div>
</div>
</body>
</html>



