@extends('template.layout')
@section('titulo', 'Bilhetes')
@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active"> <a href="{{redirect("bilhetes.index")}}">Meus Bilhetes</a> </li>
    </ol>
@endsection

@section('main')

    <div class="ticket">

        <div class="ticket-header">
            <h2>Recibo da Compra</h2>
        </div>
        <div class="ticket-details">
            <p><strong>Recibo ID:</strong> {{$recibo->id}}</p>
            <p><strong>Preço com IVA:</strong> {{$recibo->preco_total_sem_iva}}</p>
            <p><strong>IVA:</strong> {{$recibo->iva}}</p>
            <p><strong>Total com IVA:</strong> {{$recibo->preco_total_com_iva}}</p>
            <p><strong>NIF:</strong> {{$recibo->nif}}</p>
            <p><strong>Nome:</strong> {{$recibo->nome_cliente}}</p>
            <p><strong>Data:</strong> {{$sessao->data}}</p>
            <p><strong>Tipo de Pagamento:</strong> {{$recibo->tipo_pagamento}}</p>
            <p><strong>Referência de Pagamento:</strong> {{$recibo->ref_pagamento}}</p>
        </div>
        <h2>Bilhetes</h2>
        <div>
            <ul class="list-group">
                <li class="list-group-item"><strong>Bilhete:</strong> {{$bilhete->id}}</li>
                <li class="list-group-item"><strong>Fila:</strong> {{$fila}}</li>
                <li class="list-group-item"><strong>Posição:</strong> {{$posicao}}</li>
                <li class="list-group-item"><strong>Nome da Sala:</strong> {{$nome_sala}}</li>
                <li class="list-group-item"><strong>Filme:</strong> {{$titulo}}</li>
                <li class="list-group-item"><strong>Hora de Início:</strong> {{$sessao->horario_inicio}}</li>
                <li class="list-group-item"><strong>Estado:</strong> {{$bilhete->estado}}</li>
            </ul>
        </div>
    </div>
@endsection


