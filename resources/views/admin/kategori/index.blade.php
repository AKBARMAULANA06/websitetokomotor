<div class="row p-4">
    <div class="col-md-12">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-body">  
                <h5 class="card-title text-center text-white font-weight-bold bg-primary p-2 rounded">{{ $title }}</h5>
                @php
    $level = auth()->user()->level;
@endphp

@if(in_array($level, ['admin']))
                <div class="d-flex justify-content-end mb-4">
                    <a href="/admin/kategori/create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </a>
                </div>
                @endif

                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-primary">
                        <tr>
                            <th class="text-white bg-primary">No</th>
                            <th class="text-white bg-primary">Nama Kategori</th>
                            <th class="text-white bg-primary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <a href="/admin/kategori/{{ $item->id }}/edit" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/admin/kategori/{{ $item->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
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
                    {{ $kategori->links() }}
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
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
    .thead-primary {
        background-color: #007bff;
    }
    .bg-primary {
        background-color: #007bff !important;
    }
    .text-white {
        color: #ffffff !important;
    }
</style>