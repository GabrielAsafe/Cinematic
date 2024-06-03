@extends('template.layout')

@section('titulo', 'Bilhetes')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Espaço Privado</li>
        <li class="breadcrumb-item active">Meus Bilhetes</li>
    </ol>
@endsection

@section('main')

    <ul>
        @foreach ($bilhetes as $bilhete)
            <li>
                <a href="{{ route('bilhetes.show', ['bilhete' => $bilhete->id]) }}">
                    {{ $bilhete->title }}
                </a>
            </li>
        @endforeach
    </ul>

@endsection
