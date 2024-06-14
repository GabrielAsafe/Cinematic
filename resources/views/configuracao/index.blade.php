@extends('template.layout')

@section('titulo', 'Salas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Salas</li>
    </ol>
@endsection

@section('main')


    <table class="table">
        <thead class="table-dark">
        <tr>

            <th>Preço</th>
            <th>IVA</th>
            <th class="button-icon-col"></th>

        </tr>
        </thead>
        <tbody>

        @foreach ($configs as $config)
            <tr>

                <td>{{ $config->preco_bilhete_sem_iva }}</td>
                <td>{{ $config->percentagem_iva }}</td>

                <td class="button-icon-col"><a class="btn btn-dark"
                                               href="{{ route('configuracao.edit', ['configuracao' => $config]) }}">
                        <i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

