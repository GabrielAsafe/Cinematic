@extends('template.layout')

@section('titulo', 'Alterar Filme')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item"><a href="{{ route('filmes.index') }}">Filmes</a></li>
        <li class="breadcrumb-item"><strong>{{ $filme->titulo }}</strong></li>
        <li class="breadcrumb-item active">Alterar</li>
    </ol>
@endsection

@section('main')
    <form method="POST" action="{{ route('filmes.update', ['filme' => $filme]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('filmes.shared.fields', [
            'allowUpload' => true,
            'allowDelete' => true,
        ])
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('filmes.index', ['filme' => $filme]) }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
    @include('shared.confirmationDialog', [
        'title' => 'Quer realmente apagar o cartaz?',
        'msgLine1' => 'As alterações efetuadas ao dados do filme vão ser perdidas!',
        'msgLine2' => 'Clique no botão "Apagar" para confirmar a operação.',
        'confirmationButton' => 'Apagar',
        'formActionRoute' => 'filmes.cartaz.destroy',
        'formActionRouteParameters' => ['filme' => $filme],
        'formMethod' => 'DELETE',
    ])
@endsection
