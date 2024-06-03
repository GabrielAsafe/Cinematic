@extends('template.layout')

@section('titulo', 'Efetuar pagamento')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Carrinho</li>
        <li class="breadcrumb-item">Pagamento</li>


    </ol>
@endsection

@section('main')
    <h1>Detalhes do Pagamento</h1>

    <h2>Informações do Pedido</h2>
    <ul>
        <li><strong>Data da Compra:</strong> {{ session('pagamento')['DataCompra'] }}</li>
        <li><strong>Nome do Cliente:</strong> {{ session('pagamento')['NomeCliente'] }}</li>
        <li><strong>NIF (opcional):</strong> {{ session('pagamento')['NIF'] }}</li>
        <li><strong>Referência de pagamento:</strong> {{ session('pagamento')['ReferênciaPagamento'] }}</li>
        <li><strong>Tipo de pagamento:</strong> {{ session('pagamento')['TipoPagamento'] }}</li>
        <li><strong>Total sem IVA:</strong> {{ session('pagamento')['TotalsIVA'] }}</li>
        <li><strong>IVA:</strong> {{ session('pagamento')['IVA'] }}%</li>
        <li><strong>Total com IVA:</strong> {{ session('pagamento')['TotalIVA'] }}</li>
    </ul>

    <h2>Dados do Pagamento</h2>
    <ul>
        <!-- Dados do pagamento podem ser adicionados aqui se necessário -->
    </ul>

    <h2>Bilhetes</h2>
    @foreach (session('pagamento')['Bilhetes'] as $bilhete)
        <div>
            <h3>Bilhete ID: {{ $bilhete['ID'] }}</h3>
            <ul>
                <li><strong>Filme:</strong> {{ $bilhete['Filme'] }}</li>
                <li><strong>Sala:</strong> {{ $bilhete['Sala'] }}</li>
                <li><strong>Data:</strong> {{ $bilhete['Data'] }}</li>
                <li><strong>Hora:</strong> {{ $bilhete['Hora'] }}</li>
                <li><strong>Lugar:</strong> {{ $bilhete['Lugar'] }}</li>
                <li><strong>Preço:</strong> {{ $bilhete['Preço'] }}</li>
                <li><strong>Cliente:</strong> {{ $bilhete['Cliente'] }}</li>
            </ul>
        </div>
    @endforeach

    <div class="my-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary" name="ok" form="formStore">
            Confirmar Pagamento
        </button>
    </div>
    <form id="formStore" method="POST" action="{{ route('cart.store') }}" class="d-none">
        @csrf
    </form>

@endsection






