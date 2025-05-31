@extends('Backend.back')
@section('admincontent')
<div class="row">
    <div>
        <h1>{{ number_format($order->total) }}</h1>
    </div>
    <div class="col-6">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ url('admin/order/'.$order->idorder) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mt-2">
                <label class="form-label" for="">Total</label>
                <input class="form-control" min="{{ $order->total }}" value="{{ $order->total }}" type="number" name="bayar" id="">
                <span class="text-danger">
                    @error('total')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Bayar</button>
            </div>
        </form>
    </div>
</div>
@endsection