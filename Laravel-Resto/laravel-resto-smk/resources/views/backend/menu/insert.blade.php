@extends('Backend.back')
@section('admincontent')
<div class="row">
    <div class="col-6">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ url('admin/menu') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-2">
                <label class="form-label" for="">Nama Menu</label>
                <input class="form-control" type="text" name="menu" id="">
                <span class="text-danger">
                    @error('menu')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Kategori</label>
                <select class="form-select" name="idkategori">
                    @foreach ( $kategoris as $kategori )
                        <option value="{{ $kategori->idkategori }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Deskripsi</label>
                <input class="form-control"  type="text" name="deskripsi" id="">
                <span class="text-danger">
                    @error('deskripsi')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Harga</label>
                <input class="form-control" type="number" name="harga" id="">
                <span class="text-danger">
                    @error('harga')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-2">
                <label class="form-label" for="">Gambar</label>
                <input class="form-control" type="file" name="gambar" id="">
                <span class="text-danger">
                    @error('gambar')
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