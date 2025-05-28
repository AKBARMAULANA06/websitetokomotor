<div class="row p-3">
  <div class="col-md-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><b>{{ $title }}</b></h5>
        <hr>

        <!-- Form -->
        <form action="{{ isset($produk) ? url('/admin/produk/' . $produk->id) : url('/admin/produk') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if(isset($produk))
            @method('PUT')
          @endif

          <!-- Nama Produk -->
          <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Produk" value="{{ old('name', $produk->name ?? '') }}">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Kategori -->
          <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id">
              <option value="">-- Pilih Kategori --</option>
              @foreach ($kategori as $item)
                <option value="{{ $item->id }}" {{ old('kategori_id', $produk->kategori_id ?? '') == $item->id ? 'selected' : '' }}>
                  {{ $item->name }}
                </option>
              @endforeach
            </select>
            @error('kategori_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Barcode -->
          <div class="mb-3">
            <label for="barcode" class="form-label">Barcode</label>
            <div class="input-group">
              <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror" id="barcode" placeholder="Barcode" value="{{ old('barcode', $produk->barcode ?? '') }}">
              <button class="btn btn-outline-secondary" type="button" onclick="generateBarcode()">Generate Barcode</button>
              <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#scanBarcodeModal">Scan Barcode</button>
            </div>
            @error('barcode')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Harga -->
          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" value="{{ old('harga', $produk->harga ?? '') }}">
            @error('harga')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Stok -->
          <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" id="stok" placeholder="Stok" value="{{ old('stok', $produk->stok ?? '') }}">
            @error('stok')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Gambar -->
          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" id="gambar">
            @error('gambar')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Gambar Saat Ini -->
          @if(isset($produk) && $produk->gambar)
            <div class="mb-3">
              <label class="form-label">Gambar Saat Ini</label><br>
              <img src="{{ asset($produk->gambar) }}" alt="Gambar Produk" class="img-thumbnail" style="width: 150px; border-radius: 8px;">
            </div>
          @endif

          <!-- Tombol Aksi -->
          <div class="d-flex justify-content-between mt-4">
            <a href="{{ url('/admin/produk') }}" class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Scan Barcode -->
<div class="modal fade" id="scanBarcodeModal" tabindex="-1" aria-labelledby="scanBarcodeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scanBarcodeModalLabel">Scan Barcode</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <div id="scanner-container" style="width: 100%; height: 300px; border: 1px solid #ddd; margin-bottom: 10px;"></div>
        <p class="text-muted">Arahkan kamera ke barcode untuk memindai</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
<script>
  // Generate random barcode
  function generateBarcode() {
    const randomBarcode = 'BR' + Math.floor(100000000 + Math.random() * 900000000);
    document.getElementById('barcode').value = randomBarcode;
  }

  let scannerInitialized = false;

  $('#scanBarcodeModal').on('shown.bs.modal', function () {
    if (!scannerInitialized && typeof Quagga !== 'undefined') {
      Quagga.init({
        inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector('#scanner-container'),
          constraints: {
            width: 480,
            height: 320,
            facingMode: "environment"
          }
        },
        decoder: {
          readers: [
            "ean_reader", "ean_8_reader", "code_128_reader",
            "code_39_reader", "code_39_vin_reader",
            "codabar_reader", "upc_reader", "upc_e_reader"
          ]
        }
      }, function(err) {
        if (err) {
          console.error(err);
          alert("Gagal menginisialisasi scanner: " + err);
          return;
        }
        Quagga.start();
        scannerInitialized = true;
      });

      Quagga.onDetected(function(result) {
        const code = result.codeResult.code;
        document.getElementById('barcode').value = code;
        $('#scanBarcodeModal').modal('hide');
        Quagga.stop();
      });
    }
  });

  $('#scanBarcodeModal').on('hidden.bs.modal', function () {
    if (scannerInitialized && typeof Quagga !== 'undefined') {
      Quagga.stop();
    }
  });
</script>
@endpush
