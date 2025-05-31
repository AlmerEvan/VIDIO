<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Laravel Restoran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4 py-2">
            <div class="container-fluid justify-content-between">
                <span class="navbar-brand fw-bold">Admin Panel</span>
                @if(Auth::check())
                    <ul class="navbar-nav flex-row gap-3 align-items-center">
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">Level: {{ Auth::user()->level }}</span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/logout') }}" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
        </nav>

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-md-2">
                <div class="list-group shadow-sm">
                    @if(Auth::check() && Auth::user()->level == 'admin')
                        <a href="{{ url('admin/user') }}" class="list-group-item list-group-item-action">User</a>
                    @endif

                    @if(Auth::check() && Auth::user()->level == 'kasir')
                        <a href="{{ url('admin/order') }}" class="list-group-item list-group-item-action">Order</a>
                        <a href="{{ url('admin/orderdetail') }}" class="list-group-item list-group-item-action">OrderDetail</a>
                    @endif

                    @if(Auth::check() && Auth::user()->level == 'manager')
                        <a href="{{ url('admin/pelanggan') }}" class="list-group-item list-group-item-action">Pelanggan</a>
                        <a href="{{ url('admin/kategori') }}" class="list-group-item list-group-item-action">Kategori</a>
                        <a href="{{ url('admin/menu') }}" class="list-group-item list-group-item-action">Menu</a>
                        <a href="{{ url('admin/order') }}" class="list-group-item list-group-item-action">Order</a>
                        <a href="{{ url('admin/orderdetail') }}" class="list-group-item list-group-item-action">OrderDetail</a>
                    @endif
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-md-10">
                @yield('admincontent')
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-5 mb-3">
            <small class="text-muted">© {{ date('Y') }} Laravel Restoran</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
