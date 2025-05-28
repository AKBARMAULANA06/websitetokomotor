<div class="row p-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            @php
                $level = auth()->user()->level ?? null;
            @endphp
            
            <div class="card-body">
                <!-- Judul/Titel -->
                <h5 class="card-title text-center mb-4">
                    <span class="text-white" style="font-weight: bold; font-size: 1.5rem; background-color: #007bff; padding: 0.5rem 1rem; border-radius: 8px;">
                        {{ $title ?? 'Daftar Produk' }} 
                    </span>
                </h5>

                @if(isset($level) && in_array($level, ['admin']))
                    <div class="d-flex justify-content-end mb-3">
                        <a href="/admin/produk/create" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Produk
                        </a>
                    </div>
                @endif
                
                <!-- Responsive Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-white bg-primary">No</th>
                                <th class="text-white bg-primary">Nama</th>
                                <th class="text-white bg-primary">Gambar</th>
                                <th class="text-white bg-primary">Barcode</th>
                                <th class="text-white bg-primary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    @if($item->gambar)
                                        @if(Storage::disk('public')->exists($item->gambar))
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->name }}" style="max-width: 100px; height: auto;">
                                        @else
                                            <span class="text-danger">Gambar tidak ditemukan</span>
                                        @endif
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->kode_produk)
                                        <div class="barcode-container">
                                            <div class="barcode-image">
                                                {!! DNS1D::getBarcodeHTML($item->kode_produk, 'C128', 1.4, 40) !!}
                                            </div>
                                            <div class="barcode-number">{{ $item->kode_produk }}</div>
                                        </div>
                                    @else
                                        <span class="text-muted">Barcode tidak tersedia</span>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($level) && in_array($level, ['admin']))
                                        <div class="btn-group" role="group">
                                            <a href="/admin/produk/{{ $item->id }}/edit" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="/admin/produk/{{ $item->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted">Hanya admin</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $produk->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS for tooltips -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<style>
    /* Barcode Styles */
    .barcode-container {
        display: inline-block;
        text-align: center;
        background: white;
        padding: 5px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }
    
    .barcode-image svg {
        display: block;
        margin: 0 auto;
        width: 100%;
        height: auto;
    }
    
    .barcode-number {
        font-family: monospace;
        font-size: 12px;
        margin-top: 5px;
        color: #000;
    }

    /* Custom styles for the card and table */
    .card {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table {
        margin-bottom: 0;
    }

    .table th, .table td {
        vertical-align: middle;
        padding: 12px 15px;
    }

    .table-primary {
        background-color: #007bff;
    }

    .table-primary th {
        color: white;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: all 0.3s ease;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        transition: all 0.3s ease;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        transition: all 0.3s ease;
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .btn-group .btn {
        margin-right: 5px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .text-muted {
        color: #6c757d !important;
    }

    /* Pagination styling */
    .pagination {
        margin-bottom: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table td, .table th {
            padding: 8px 10px;
            font-size: 14px;
        }
        
        .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    }
</style>