@extends('Backend.back')
@section('admincontent')
    <div>
        <h1>order detail</h1>
    </div>
    <div>
        <h2>Pelanggan: {{ $orders [0] ['pelanggan'] }}</h2>
        <h2>Total: {{ number_format($orders [0]['total']) }}</h2>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
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
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $order->menu }}</td>
                        <td>{{ $order->harga }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>{{ $order->jumlah * $order->harga }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection