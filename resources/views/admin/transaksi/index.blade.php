<div class="row p-4">
    <div class="col-md-12">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-body">
                <h5 class="card-title text-center text-white font-weight-bold bg-primary p-2 rounded">{{ $title }}</h5>
                <div class="d-flex justify-content-end mb-4">
                    <a href="/admin/transaksi/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah +
                    </a>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-primary">
                        <tr>
                            <th class="text-white bg-primary">No</th>
                            <th class="text-white bg-primary">User Id</th>
                            <th class="text-white bg-primary">Total</th>
                            <th class="text-white bg-primary">Nama Kasir</th>
                            <th class="text-white bg-primary">Status</th>
                            <th class="text-white bg-primary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ number_format($item->total, 2) }}</td>
                            <td>{{ $item->kasir_name }}</td>
                            <td>
                                <span class="badge {{ $item->status == 'Completed' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="/admin/transaksi/{{ $item->id }}/edit" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/admin/transaksi/{{ $item->id }}" method="POST" class="ml-1">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: scale(1.02);
    }
    .btn-primary {
        background-color: #007bff; /* Warna biru untuk tombol */
        border-color: #007bff;
    }
    .btn-info {
        background-color: #17a2b8; /* Warna biru muda untuk tombol edit */
        border-color: #17a2b8;
    }
    .btn-danger {
        background-color: #dc3545; /* Warna merah untuk tombol hapus */
        border-color: #dc3545;
    }
    .thead-primary {
        background-color: #007bff; /* Warna biru untuk header tabel */
    }
    .bg-primary {
        background-color: #007bff !important; /* Warna biru untuk latar belakang */
    }
    .text-white {
        color: white !important; /* Warna teks putih */
    }
    .badge-success {
        background-color: #28a745; /* Warna hijau untuk badge Completed */
    }
    .badge-warning {
        background-color: #ffc107; /* Warna kuning untuk badge Pending */
    }
</style>