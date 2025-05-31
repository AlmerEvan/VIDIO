@extends('Backend.back')

@section('admincontent')
    <div class="mb-3">
        <h1 class="h4">Data Order</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration + ($orders->firstItem() - 1) }}</td>
                        <td>
                            <a href="{{ url('admin/order/' . $order->idorder . '/edit') }}" class="text-decoration-none">
                                {{ $order->pelanggan }}
                            </a>
                        </td>
                        <td>{{ $order->tglorder }}</td>
                        <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>{{ number_format($order->bayar, 0, ',', '.') }}</td>
                        <td>{{ number_format($order->kembali, 0, ',', '.') }}</td>
                        <td>
                            @if ($order->status == 1)
                                <span class="btn btn-success btn-sm disabled">Lunas</span>
                            @else
                                <a href="{{ url('admin/order/' . $order->idorder) }}" class="btn btn-danger btn-sm">Bayar</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data order</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $orders->links() }}
    </div>
@endsection
