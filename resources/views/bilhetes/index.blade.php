@extends('template.layout')

@section('titulo', 'Bilhetes')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item">Meus Bilhetes</li>
    </ol>
@endsection

@section('main')
    <div class="container">


            @foreach ($bilhetes as $bilhete)
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-4">
                            <h3>Bilhete ID: {{ $bilhete->id }}</h3>
                            <p><strong>Recibo ID:</strong> {{ $bilhete->recibo_id }}</p>
                            <p><strong>Cliente ID:</strong> {{ $bilhete->cliente_id }}</p>
                            <p><strong>Sessão ID:</strong> {{ $bilhete->sessao_id }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Lugar ID:</strong> {{ $bilhete->lugar_id }}</p>
                            <p><strong>Preço sem IVA:</strong> {{ $bilhete->preco_sem_iva }}</p>
                            <p><strong>Estado:</strong> {{ $bilhete->estado }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Criado em:</strong> {{ $bilhete->created_at }}</p>
                            <p><strong>Atualizado em:</strong> {{ $bilhete->updated_at }}</p>
                        </div>
                        <a class="btn btn-secondary"
                           href="{{ route('bilhetes.show',['bilhete'=>$bilhete]) }}">
                            <i class="fas fa-eye"></i></a>
                    </div>
                </div>
        @endforeach
        {!! $bilhetes->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

@endsection



