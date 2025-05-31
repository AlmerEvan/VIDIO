@extends('Backend.back')

@section('admincontent')

<div class="mb-4">
    <h1 class="fs-3 fw-semibold">Menu</h1>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <form action="{{ url('admin/select') }}" method="get">
            <select class="form-select shadow-sm border-0" name="idkategori" onchange="this.form.submit()">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->idkategori }}"
                        {{ request('idkategori') == $kategori->idkategori ? 'selected' : '' }}>
                        {{ $kategori->kategori }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="table-responsive shadow-sm rounded">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Menu</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $index => $menu)
                <tr>
                    <td>{{ $menus->firstItem() + $index }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td>{{ $menu->menu }}</td>
                    <td>{{ $menu->deskripsi }}</td>
                    <td>
                        <img src="{{ asset('gambar/' . $menu->gambar) }}" alt="{{ $menu->menu }}" width="60" class="img-thumbnail border-0">
                    </td>
                    <td>{{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ url('admin/menu/' . $menu->idmenu . '/edit') }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{ url('admin/menu/' . $menu->idmenu) }}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if ($menus->isEmpty())
                <tr>
                    <td colspan="8" class="text-center text-muted">Data menu tidak ditemukan</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $menus->withQueryString()->links() }}
</div>

<div class="mt-3">
    <a href="{{ url('admin/menu/create') }}" class="btn btn-primary">Tambah Data</a>
</div>

@endsection
