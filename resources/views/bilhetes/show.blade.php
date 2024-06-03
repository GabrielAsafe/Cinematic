@extends('template.layout')
@section('titulo', 'Bilhetes')
@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active"> <a href="{{redirect("bilhetes.index")}}">Meus Bilhetes</a> </li>
    </ol>
@endsection

@section('main')
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <div class="col-md-12">
                <h3>Bilhete ID: {{ $bilhete->id }}</h3>
                <p><strong>Recibo ID:</strong> {{ $bilhete->recibo_id }}</p>
                <p><strong>Cliente ID:</strong> {{ $bilhete->cliente_id }}</p>
                <p><strong>Sessão ID:</strong> {{ $bilhete->sessao_id }}</p>
            </div>
            <div class="col-md-12">
                <p><strong>Lugar ID:</strong> {{ $bilhete->lugar_id }}</p>
                <p><strong>Preço sem IVA:</strong> {{ $bilhete->preco_sem_iva }}</p>
                <p><strong>Estado:</strong> {{ $bilhete->estado }}</p>
            </div>
            <div class="col-md-12">
                <p><strong>Criado em:</strong> {{ $bilhete->created_at }}</p>
                <p><strong>Atualizado em:</strong> {{ $bilhete->updated_at }}</p>
            </div>
        </div>
    </div>
@endsection
