<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Toko</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    
    <div class="container">
        <div class="mt-5">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a href="/"><img style="width: 100px" src="{{ asset('gambar/logo.jpg') }}" alt=""></a>
                    <ul class="navbar-nav gap-5">
                        <li class="nav-item"><a href="{{ url('/cart') }}">Cart</a></li>
                        @if (Session::has('idpelanggan'))
                            <li class="nav-item">{{ Session::get('email') }}</li>
                            <li class="nav-item"><a href="{{ url('logout') }}">Log out</a></li>
                        @else
                            <li class="nav-item"><a href="{{ url('register') }}">Register</a></li>
                            <li class="nav-item"><a href="{{ url('login') }}">Log in</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row mt-4">
            <div class="col-2">
                <ul class="list-group">
                    @if (isset($kategoris) && $kategoris->count())
                        @foreach ($kategoris as $kategori)
                            <li class="list-group-item"><a href="{{ url('show/'.$kategori->idkategori) }}">{{ $kategori->kategori }}</a></li>
                        @endforeach
                    @else
                        <li class="list-group-item">No categories available</li>
                    @endif
                </ul>
            </div>
            <div class="col-10">
                @yield('content')
            
            </div>
        </div>
        <!-- Footer -->
        <footer class="text-center mt-5 mb-3">
            <small class="text-muted">© {{ date('Y') }} Laravel Restoran</small>
        </footer>
    </div>

    <script> src="{{ asset('bootstrap/css/bootstrap.min.css') }}" </script>
</body>
</html>