@if (isset($filme->cartaz_url))
    <img src="{{ $filme->fullCartazUrl }}" alt="{{ $filme->cartaz_url }}" class="img-thumbnail">
@else
    <img src="/img/avatar_unknown.png" alt="Cartaz" class="img-thumbnail">
@endif

@if ($allowUpload)
    <div class="mb-3 pt-3">
        <input type="file" class="form-control @error('cartaz_url') is-invalid @enderror" name="cartaz_url"
            id="inputcartaz" value="{{ old('cartaz_url', $filme->cartaz_url) }}">
        @error('cartaz_url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif

@if (($allowDelete ?? false) && $filme->cartaz_url)
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal">
        Apagar Cartaz
    </button>
@endif
