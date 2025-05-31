@extends('Backend.back')

@section('admincontent')
<div class="mb-4">
    <h1 class="fs-3 fw-semibold">Kategori</h1>
</div>

<div class="table-responsive shadow-sm rounded">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kategori</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @php $no = 1; @endphp
            @foreach ($kategoris as $kategori)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $kategori->kategori }}</td>
                    <td>
                        <a href="{{ url('admin/kategori/'.$kategori->idkategori.'/edit') }}"
                           class="btn btn-sm btn-outline-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{ url('admin/kategori/'.$kategori->idkategori) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3 d-flex justify-content-end gap-2">
    <a href="{{ url('admin/kategori/create') }}" class="btn btn-primary">Tambah</a>
    
    <form action="{{ url('admin/kategori') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua kategori?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger">Hapus Semua</button>
    </form>
</div>
@endsection
