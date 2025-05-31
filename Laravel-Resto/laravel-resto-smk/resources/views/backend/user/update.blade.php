@extends('Backend.back')
@section('admincontent')
<div class="row">
    <div class="col-6">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ url('admin/user/'.$user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mt-2">
                <label class="form-label" for="">Nama</label>
                <input class="form-control" value="{{ $user->name }}" type="text" name="name" id="">
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Email</label>
                <input class="form-control" value="{{ $user->email }}" type="text" name="email" id="">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Password</label>
                <input class="form-control" type="text" name="password" id="">
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Level</label>
                <select @selected( $user->level ) class="form-select" name="level">
                    <option value="manager">manager</option>
                    <option value="kasir">kasir</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection