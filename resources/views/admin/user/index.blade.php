<div class="container-fluid pt-2">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-white"><i class="fas fa-users mr-2"></i><b>{{$title}}</b></h5>
                </div>
                <div class="card-body">
                    <a href="/admin/user/create" class="btn custom-blue text-white mb-3">
                        <i class="fas fa-plus mr-1"></i> Tambah User
                    </a>

                    @if(session()->has('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: '{{ session('success') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover mt-1">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $item->level == 'admin' ? 'badge-primary' : 'badge-secondary' }}">
                                            {{ $item->level }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/admin/user/{{$item->id}}/edit" 
                                               class="btn btn-info btn-sm text-white"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="/admin/user/{{$item->id}}" method="POST" class="delete-form ml-1">
                                                @method('delete')
                                                @csrf
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm delete-btn"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Warna Biru Utama */
    .custom-blue, .btn-info {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
    }
    
    .custom-blue:hover, .btn-info:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        color: white;
    }
    
    /* Header Card */
    .card-header {
        background-color: #3498db;
        color: white;
    }
    
    /* Tabel */
    .table th {
        background-color: #f8f9fa;
    }
    
    .table tr:nth-child(even) {
        background-color: #f2f9ff;
    }
    
    .table tr:hover {
        background-color: #e7f4ff;
    }
    
    /* Tombol Aksi */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>

<script>
    // SweetAlert untuk konfirmasi penghapusan
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // SweetAlert untuk notifikasi sukses dari session
    @if(session()->has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>