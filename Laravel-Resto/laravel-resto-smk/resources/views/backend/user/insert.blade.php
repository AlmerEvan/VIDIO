@extends('Backend.back')
@section('admincontent')
<div class="row">
    <div class="col-6">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ url('admin/user') }}" method="post">
            @csrf
            <div class="mt-2">
                <label class="form-label" for="">Nama</label>
                <input class="form-control" value="{{ old('name') }}" type="text" name="name" id="">
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Email</label>
                <input class="form-control" value="{{ old('email') }}" type="text" name="email" id="">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            <div class="mt-2">
                <label class="form-label" for="">Password</label>
                <input class="form-control" value="{{ old('password') }}" type="text" name="password" id="">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Level</label>
                <select class="form-select" name="level">
                    <option value="manager">manager</option>
                    <option value="kasir">kasir</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection