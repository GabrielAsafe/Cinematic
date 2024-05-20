@extends('template.layout')

@section('titulo', 'filmes')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item active">Filmes</li>
    </ol>
@endsection

@section('main')
    <p><a class="btn btn-success" href="{{ route('filmes.create') }}"><i class="fas fa-plus"></i> &nbsp;Criar novo
            filmes</a></p>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Cartaz</th>
                <th>Titulo</th>
                <th>Genero</th>
                <th>Ano</th>
                <th>Sumario</th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
                <th class="button-icon-col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filmes as $filme)
                <tr>
                    <td><img src="cinematic/storage/app/public/cartazes/{{ $filme->cartaz_url }}" alt="{{ $filme->cartaz_url }}"></td>
                    <td>{{ $filme->titulo }}</td>
                    <td>{{ $filme->genero_code }}</td>
                    <td>{{ $filme->ano }}</td>
                    <td>{{ $filme->sumario }}</td>
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('filmes.show', ['filme' => $filme]) }}">
                            <i class="fas fa-eye"></i></a></td>
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('filmes.edit', ['filme' => $filme]) }}">
                            <i class="fas fa-edit"></i></a></td>
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('filmes.destroy', ['filme' => $filme]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $filmes->links() }}
    </div>
@endsection
