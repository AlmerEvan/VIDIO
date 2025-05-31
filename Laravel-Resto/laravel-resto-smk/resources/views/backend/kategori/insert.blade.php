
@extends('Backend.back')
@section('admincontent')
<div class="row">
    <div class="col-6">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ url('admin/kategori') }}" method="post">
            @csrf
            <div class="mt-2">
                <label class="form-label" for="">Kategori</label>
                <input class="form-control" value="{{ old('kategori') }}" type="text" name="kategori" id="">
                <span class="text-danger">
                    @error('kategori')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection
