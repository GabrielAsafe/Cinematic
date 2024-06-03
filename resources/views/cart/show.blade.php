@extends('template.layout')
@section('titulo', 'Carrinho')
@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Carrinho</li>
    </ol>
@endsection

@section('main')
    <div>
        <h3>Assentos no carrinho</h3>
    </div>
    @if ($cart)
        @include('lugares.shared.table', [
            'lugares' => $cart,
            'showDetail' => false,
            'showEdit' => false,
            'showDelete' => false,
            'showAddCart' => false,
            'showRemoveCart' => true,
        ])
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok" form="formStore">
               Efetuar Pagamento</button>
            <button type="submit" class="btn btn-danger ms-3" name="clear" form="formClear">
                Limpar Carrinho</button>
        </div>
        <form id="formStore" method="POST" action="{{ route('cart.validatePayment') }}" class="d-none">
            @csrf
        </form>
        <form id="formClear" method="POST" action="{{ route('cart.destroy') }}" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection


<?php
session()->put('cart', $cart);
?>
