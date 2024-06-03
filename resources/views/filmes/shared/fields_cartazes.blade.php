<img src="{{ $filme->fullCartazUrl }}" alt="Avatar" class="img-thumbnail">

@if ($allowUpload)
    <div class="mb-3 pt-3">
        <input type="file" class="form-control @error('file_cartaz') is-invalid @enderror" name="file_cartaz"
            id="inputcartaz">
        @error('file_cartaz')
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
