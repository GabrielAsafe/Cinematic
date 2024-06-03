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
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('filmes.shared.fields', [
                    'filme' => $filme,
                    'generos' => $generos,
                    'readonlyData' => false,
                ])
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('filmes.shared.fields_cartazes', [
                    'filme' => $filme,
                    'allowUpload' => true,
                    'allowDelete' => true,
                ])
            </div>

        </div>
        <div class="my-4 d-flex justify-content-start">
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
