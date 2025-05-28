<div class="container-fluid pt-2">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4><b>{{ isset($user) ? 'Edit Data' : 'Tambah Data' }}</b></h4>

                    @isset($user)
                        <form id="userForm" action="/admin/user/{{$user->id}}" method="POST">
                            @method('put')
                    @else
                        <form id="userForm" action="/admin/user" method="POST">
                    @endisset
                    
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Nama Lengkap</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                                   placeholder="Nama Lengkap" value="{{ isset($user) ? $user->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Email</b></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                   placeholder="Email" value="{{ isset($user) ? $user->email : old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level"><b>Level</b></label>
                            <select class="form-control @error('level') is-invalid @enderror" name="level">
                                <option value="">Pilih Level</option>
                                <option value="admin" {{ (isset($user) && $user->level == 'admin') || old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ (isset($user) && $user->level == 'user') || old('level') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('level')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for=""><b>Password</b></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Konfirmasi Password</b></label>
                            <input type="password" class="form-control @error('re_password') is-invalid @enderror" name="re_password" placeholder="Konfirmasi Password">

                            @error('re_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <a href="/admin/user" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // SweetAlert for form submission
    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyimpan data ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // SweetAlert for success message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = '/admin/user'; // Redirect after success
        });
    @endif

    // SweetAlert for validation errors
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: `
                <ul class="text-left">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonText: 'Mengerti'
        });
    @endif
</script>

<style>
    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #3498db;
        color: white;
    }
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
    }
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
</style>