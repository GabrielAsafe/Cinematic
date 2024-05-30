@php
    $disabledStr = $readonlyData ?? false ? 'disabled' : '';
@endphp

<div class="d-flex justify-content-between">
    <div class="mb-3 form-floating flex-grow-1">
        <input type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" id="inputNIF"
            {{ $disabledStr }} value="{{ old('nif', $cliente->nif) }}">
        <label for="inputnif" class="form-label">NIF</label>
        @error('nif')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="d-flex justify-content-between">
    <div class="mb-3 form-floating flex-grow-1">
        <input type="text" class="form-control @error('tipo_pagamento') is-invalid @enderror" name="tipo_pagamento" id="input_tipo_pagamento"
            {{ $disabledStr }} value="{{ old('tipo_pagamento', $cliente->tipo_pagamento) }}">
        <label for="input_tipo_pagamento" class="form-label">Tipo de pagamento</label>
        @error('tipo_pagamento')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="d-flex justify-content-between">
    <div class="mb-3 form-floating flex-grow-1">
        <input type="text" class="form-control @error('ref_pagamento') is-invalid @enderror" name="ref_pagamento" id="input_ref_pagamento"
            {{ $disabledStr }} value="{{ old('ref_pagamento', $cliente->ref_pagamento) }}">
        <label for="input_ref_pagamento" class="form-label">Ref Pagamento</label>
        @error('ref_pagamento')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <div class="form-check form-switch" {{ $disabledStr }}>
        <input type="hidden" name="bloqueado" value="0">
        <input type="checkbox" class="form-check-input @error('bloqueado') is-invalid @enderror" name="bloqueado"
            id="inputOpcional" {{ $disabledStr }} {{ old('bloqueado', $cliente->user->bloqueado) ? 'checked' : '' }} value="1">
        <label for="inputOpcional" class="form-check-label">Bloqueado</label>
        @error('bloqueado')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>



