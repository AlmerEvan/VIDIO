@extends('Backend.back')

@section('admincontent')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Data Pelanggan</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggans as $pelanggan)
                    <tr>
                        <td>{{ $loop->iteration + ($pelanggans->firstItem() - 1) }}</td>
                        <td>{{ $pelanggan->pelanggan }}</td>
                        <td>{{ $pelanggan->alamat }}</td>
                        <td>{{ $pelanggan->email }}</td>
                        <td>{{ $pelanggan->telp }}</td>
                        <td>
                            @if ($pelanggan->aktif == 1)
                                <a href="{{ url('admin/pelanggan/' . $pelanggan->idpelanggan) }}" class="btn btn-success btn-sm">Aktif</a>
                            @else
                                <a href="{{ url('admin/pelanggan/' . $pelanggan->idpelanggan) }}" class="btn btn-danger btn-sm">Banned</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data pelanggan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $pelanggans->links() }}
    </div>
@endsection
