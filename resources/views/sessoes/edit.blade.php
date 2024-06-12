@extends('template.layout')

@section('titulo', 'Editar sessão')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Gestão</li>
        <li class="breadcrumb-item">Curricular</li>
        <li class="breadcrumb-item">Filmes</a></li>
        <li class="breadcrumb-item active">Criar Novo</li>
    </ol>
@endsection

@section('main')
@include('sessoes.shared.table', [
            'sessoes' => $filme->sessoes,
            'v_filme' => $filme,
            'showDetail' => false,
            'showEdit' => false,
            'showDelete' => false,
            'showMenageSession' => false,
            'showEsgotada' => false,
            'showSelect' => true
        ])
    <form method="POST" action="{{ route('filmes.sessao.update', ['filme' => $filme]) }}" enctype="multipart/form-data" style="width: 83%">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="sessao_id" class="form-label">ID da Sessão</label>
            <input type="text" class="form-control" id="sessao_id" name="sessao_id" readonly>
        </div>
        @include('sessoes.shared.fields')
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Editar sessão</button>
            <a href="{{ route('filmes.show', ['filme' => $filme]) }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
             // This event listener ensures that the DOM is fully loaded before executing the code inside.

             // Select all buttons with class 'fill-session-id'
            const fillSessionButtons = document.querySelectorAll('.fill-session-id');

            // Select the input element with id 'sessao_id'
            const sessaoIdInput = document.getElementById('sessao_id');

            // Add click event listener to each button
            fillSessionButtons.forEach(button => {
                button.addEventListener('click', function () {
                    
                    // When a button is clicked, get the value of 'data-session-id' attribute
                    const sessionId = this.getAttribute('data-session-id');

                    // Set the value of sessao_id input field to the sessionId
                    sessaoIdInput.value = sessionId;
                });
            });
        });
    </script>
@endsection
