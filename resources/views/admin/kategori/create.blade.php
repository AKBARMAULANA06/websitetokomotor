<div class="row p-4">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-center"><b>{{ $title }}</b></h5>
                <hr>
                @isset($kategori)
                    <form action="/admin/kategori/{{ $kategori->id }}" method="POST">
                        @method('PUT')
                @else
                    <form action="/admin/kategori" method="POST">
                @endisset

                @csrf
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Kategori" value="{{ isset($kategori) ? $kategori->name : old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="/admin/kategori" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <div class="ml-auto">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>