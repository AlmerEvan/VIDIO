@extends('Backend.back')
@section('admincontent')
    <div>
        <h1>Order Detail</h1>
    </div>
        <form action="{{ url('admin/orderdetail/create') }}" method="get">
        <div class="row">
            @csrf
            <div class="mt-2 col-4">
                <label class="form-label" for="">Tanggal Mulai</label>
                <input class="form-control"  type="date" name="tglmulai" id="">
            </div>
            <div class="mt-2 col-4">
                <label class="form-label" for="">Tanggal Akhir</label>
                <input class="form-control"  type="date" name="tglakhir" id="">
            </div>
            <div class="my-4 col-4">
                <p></p>
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </div>
        </form>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Pelanggan</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody class="table-group-divider">
                @foreach ($details as $detail)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $detail->tglorder }}</td>
                        <td>{{ $detail->pelanggan }}</td>
                        <td>{{ $detail->menu }}</td>
                        <td>{{ $detail->harga }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ $detail->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $details->links() }}
        </div>
    </div>
@endsection