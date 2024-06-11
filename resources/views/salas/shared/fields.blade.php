@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="mb-3 form-floating">
    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" id="inputnome"
    {{ $disabledStr }} value="{{ old('nome', $sala->nome) }}">
    <label for="inputAbr" class="form-label">nome</label>
    @error('nome')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


