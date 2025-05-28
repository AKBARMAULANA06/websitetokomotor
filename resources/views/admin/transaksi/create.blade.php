<div class="container-fluid p-4">
    <div class="row">
        <!-- Add Product Card -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-cube mr-2"></i>Tambah Produk</h5>
                </div>
                <div class="card-body">
                    <form method="GET" class="mb-4">
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">Kode Produk</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <select name="produk_id" class="form-control select2" style="width: 100%">
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->id }}" {{ request('produk_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->id . ' - ' . $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check mr-1"></i> Pilih
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="/admin/transaksi/detail/create" method="POST">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ Request::segment(3) }}">
                        <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                        <input type="hidden" name="produk_name" value="{{ isset($p_detail) ? $p_detail->name : '' }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">Nama Produk</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control bg-light" value="{{ isset($p_detail) ? $p_detail->name : '-' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">Harga Satuan</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control bg-light text-right" value="{{ isset($p_detail) ? number_format($p_detail->harga, 0, ',', '.') : '0' }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-md-4 col-form-label font-weight-bold">QTY</label>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}" class="btn btn-danger btn-sm px-3">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                    <input type="number" value="{{ $qty }}" id="qty" class="form-control mx-2 text-center" name="qty" min="1">
                                    <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}" class="btn btn-success btn-sm px-3">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label"></label>
                            <div class="col-md-8">
                                <div class="alert alert-success p-2 mb-0">
                                    <h5 class="mb-0 text-right">Sub Total: Rp {{ number_format($subtotal, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 d-flex justify-content-end">
                                <a href="/admin/transaksi" class="btn btn-secondary mr-2">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Produk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Transaction List Card -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-gradient-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-list-alt mr-2"></i>Daftar Transaksi</h5>
                    <div>
                        <span class="badge badge-light text-dark mr-2">Items: {{ $transaksi_detail->count() }}</span>
                        <span class="badge badge-light text-dark">Total: Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Nama Produk</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Subtotal</th>
                                    <th class="text-center" style="width: 60px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi_detail as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->produk_name }}</td>
                                        <td class="text-right">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="/admin/transaksi/detail/delete/{{ $item->id }}" class="btn btn-sm btn-danger delete-btn" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between">
                        <a href="#" class="btn btn-warning">
                            <i class="fas fa-file-export mr-1"></i> Pending
                        </a>
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-check-circle mr-1"></i> Selesai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Payment Summary Card -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-calculator mr-2"></i>Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Total Belanja</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control text-right" value="{{ $transaksi->total }}" name="total_belanja" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Diskon</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control text-right" name="diskon" value="{{ request('diskon') ?? $transaksi->diskon }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label font-weight-bold">Dibayarkan</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control text-right" name="dibayarkan" value="{{ request('dibayarkan') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-calculator mr-1"></i> Hitung
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label font-weight-bold">Total Setelah Diskon</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                @php
                                    $diskon = request('diskon') ?? $transaksi->diskon;
                                    $total_setelah_diskon = max(0, $transaksi->total - $diskon);
                                @endphp
                                <input type="number" class="form-control text-right bg-light" value="{{ $total_setelah_diskon }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-md-4 col-form-label font-weight-bold">Uang Kembalian</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                @php
                                    $dibayarkan = request('dibayarkan') ?? 0;
                                    $kembalian = max(0, $dibayarkan - $total_setelah_diskon);
                                @endphp
                                <input type="number" class="form-control text-right bg-light" value="{{ $kembalian }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipt Card -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-gradient-warning text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-receipt mr-2"></i>Struk Pembayaran</h5>
                    <button onclick="printReceipt()" class="btn btn-light btn-sm">
                        <i class="fas fa-print mr-1"></i> Cetak
                    </button>
                </div>
                <div class="card-body p-3 d-flex justify-content-center">
                    <div class="receipt" id="receipt" style="width: 280px;">
                        <div class="text-center mb-3">
                            <img src="{{ asset('uploads/images/honda.png') }}" alt="Logo Toko" style="width: 80px; height: auto;">
                            <h6 class="text-center font-weight-bold mt-2 mb-1" style="font-size: 16px;">TOKO MOTOR HONDA</h6>
                            <p class="text-center mb-0" style="font-size: 12px;">Jl. Bantul, Yogyakarta</p>
                            <p class="text-center mb-2" style="font-size: 11px;">Telp: 0882-2952-3216</p>
                        </div>
                        
                        <hr style="border-top: 1px dashed #000; margin: 8px 0;">
                        
                        <div class="d-flex justify-content-between mb-1" style="font-size: 12px;">
                            <span><strong>Tanggal:</strong></span>
                            <span id="tanggal_pembelian"></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size: 12px;">
                            <span><strong>Waktu:</strong></span>
                            <span id="waktu_pembelian"></span>
                        </div>
                        
                        <hr style="border-top: 1px dashed #000; margin: 8px 0;">
                        
                        <table class="w-100 mb-2" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="padding: 2px; text-align: left; width: 10%;">No</th>
                                    <th style="padding: 2px; text-align: left; width: 40%;">Item</th>
                                    <th style="padding: 2px; text-align: right; width: 20%;">Harga</th>
                                    <th style="padding: 2px; text-align: center; width: 10%;">Qty</th>
                                    <th style="padding: 2px; text-align: right; width: 20%;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi_detail as $item)
                                <tr>
                                    <td style="padding: 2px; text-align: left;">{{ $loop->iteration }}</td>
                                    <td style="padding: 2px; text-align: left;">{{ $item->produk_name }}</td>
                                    <td style="padding: 2px; text-align: right;">{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td style="padding: 2px; text-align: center;">{{ $item->qty }}</td>
                                    <td style="padding: 2px; text-align: right;">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <hr style="border-top: 1px dashed #000; margin: 8px 0;">
                        
                        <div class="mb-1" style="font-size: 12px;">
                            <div class="d-flex justify-content-between">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Diskon:</span>
                                <span>Rp {{ number_format(request('diskon') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between font-weight-bold">
                                <span>Total:</span>
                                <span>Rp {{ number_format($total_setelah_diskon, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <hr style="border-top: 1px dashed #000; margin: 8px 0;">
                        
                        <div class="mb-2" style="font-size: 12px;">
                            <div class="d-flex justify-content-between">
                                <span>Tunai:</span>
                                <span>Rp {{ number_format(request('dibayarkan') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between font-weight-bold">
                                <span>Kembali:</span>
                                <span>Rp {{ number_format($kembalian, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <hr style="border-top: 1px dashed #000; margin: 8px 0;">
                        
                        <p class="text-center font-weight-bold mb-2" style="font-size: 12px;">Terima kasih telah berbelanja!</p>
                        
                        <div class="text-center mt-3">
                            <p style="font-size: 11px; margin-bottom: 2px;">Kasir: {{ auth()->user()->name }}</p>
                            <p style="font-size: 10px; margin-bottom: 0;">{{ date('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header {
        padding: 1rem 1.25rem;
    }
    
    .receipt {
        background: #ffffff;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3498db, #2c3e50);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #1abc9c, #16a085);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f39c12, #e67e22);
    }
    
    .table th {
        white-space: nowrap;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    .select2-container .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 36px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
</style>

<script>
    // Print receipt function
    function printReceipt() {
        var printContents = document.getElementById("receipt").innerHTML;
        var originalContents = document.body.innerHTML;
        
        document.body.innerHTML = `
            <html>
                <head>
                    <title>Struk Pembayaran</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 10px;
                        }
                        .receipt {
                            width: 280px;
                            margin: 0 auto;
                            background: white;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            font-size: 12px;
                        }
                        th, td {
                            padding: 2px;
                        }
                        th {
                            text-align: left;
                        }
                        .text-center {
                            text-align: center;
                        }
                        .text-right {
                            text-align: right;
                        }
                        hr {
                            border-top: 1px dashed #000;
                            margin: 8px 0;
                        }
                    </style>
                </head>
                <body>${printContents}</body>
            </html>`;
        
        window.print();
        document.body.innerHTML = originalContents;
    }

    // Set current date and time
    document.addEventListener("DOMContentLoaded", function() {
        var now = new Date();
        var options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        };
        var tanggal = now.toLocaleDateString('id-ID', options);
        var waktu = now.toLocaleTimeString('id-ID');
        document.getElementById("tanggal_pembelian").textContent = tanggal;
        document.getElementById("waktu_pembelian").textContent = waktu;
        
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Pilih Produk",
            allowClear: true
        });
        
        // Delete confirmation
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Anda yakin ingin menghapus produk ini dari transaksi?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
</script>