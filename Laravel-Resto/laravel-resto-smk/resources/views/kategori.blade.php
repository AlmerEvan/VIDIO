@extends('front')

@section('content')
<div class="row">
    @foreach ($Menus as $menu)
    <div class="card mx-2 mb-2" style="width: 13rem;">
    
        <img src="{{ asset('gambar/'.$menu->gambar) }}" class="card-img-top img-fluid" alt="..." style="height: 140px; object-fit: cover;">
    
        <div class="card-body">
          <h5 class="card-title">{{ $menu->menu }}</h5>
          <p class="card-text">{{ $menu->deskripsi }}</p>
          <p class="card-text"><strong>Rp {{ number_format($menu->harga, 0, ',', '.') }}</strong></p>
          <a href="{{ url('/beli/' . $menu->idmenu) }}" class="btn btn-primary w-100">Beli</a>
     </div>
 </div>
    @endforeach

    <div class="d-flex justify-content-center mt-4">
        {{ $Menus->onEachSide(1)->links('pagination::simple-bootstrap-4') }}
    </div>
    
</div>
@endsection