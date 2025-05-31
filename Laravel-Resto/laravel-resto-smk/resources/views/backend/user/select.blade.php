@extends('Backend.back')

@section('admincontent')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Data User</h1>
        <a href="{{ url('admin/user/create') }}" class="btn btn-primary btn-sm">Tambah User</a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->level) }}</td>
                        <td>
                            <a href="{{ url('admin/user/' . $user->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                            <form action="{{ url('admin/user/' . $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
