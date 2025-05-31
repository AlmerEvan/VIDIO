@extends('front')

@section('content')
    @if (session('cart'))
        <div class="container-fluid px-0">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold">Keranjang Belanja</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Item Pesanan</h5>
                            <a class="btn btn-outline-danger btn-sm" href="{{ url('batal') }}">
                                Kosongkan Keranjang
                            </a>
                        </div>
                        <div class="card-body p-0">
                            @php
                                $total = 0;
                                $no = 1;
                            @endphp

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Menu</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (session('cart') as $idmenu => $menu)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            $gambarPath = isset($menu['gambar']) ? 'gambar/'.$menu['gambar'] : 'gambar/default.jpg';
                                                        @endphp
                                                        <img src="{{ asset($gambarPath) }}"
                                                             alt="{{ $menu['menu'] }}"
                                                             class="rounded me-2"
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0">{{ $menu['menu'] }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Rp {{ number_format($menu['harga'], 0, ',', '.') }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ url('kurang/' . $menu['idmenu']) }}" class="btn btn-sm btn-outline-secondary me-2">
                                                            -
                                                        </a>
                                                        <span class="mx-2">{{ $menu['jumlah'] }}</span>
                                                        <a href="{{ url('tambah/' . $menu['idmenu']) }}" class="btn btn-sm btn-outline-secondary ms-2">
                                                            +
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>Rp {{ number_format($menu['jumlah'] * $menu['harga'], 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ url('hapus/'.$menu['idmenu']) }}" class="btn btn-sm btn-outline-danger">
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                            @php
                                                $total += $menu['jumlah'] * $menu['harga'];
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Ringkasan Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Pembayaran</span>
                                <span>Rp {{ number_format($total) }}</span>
                            </div>

                            <div class="mt-4">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-primary" href="{{ url('checkout') }}">
                                        Checkout Sekarang
                                    </a>
                                    <a class="btn btn-outline" href="{{ url('menu') }}">
                                        Lanjutkan Belanja
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h3 class="mb-3">Keranjang Belanja Kosong</h3>
            <p class="text-muted mb-4">Anda belum menambahkan menu apapun ke keranjang.</p>
            <a href="{{ url('menu') }}" class="btn btn-primary">
                Lihat Menu
            </a>
        </div>

        <script>
            // Redirect after 3 seconds if cart is empty
            setTimeout(function() {
                window.location.href = '/';
            }, 3000);
        </script>
    @endif
@endsection