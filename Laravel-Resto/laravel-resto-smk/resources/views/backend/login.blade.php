<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin LARAVEL Restoran</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-4">
                <h2 class="text-center">Login Admin</h2>
                <hr>
            <div class="col-12">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ url('admin/postlogin') }}" method="post">
                    @csrf
                    <div class="mt-2">
                        <label class="form-label" for="">Email</label>
                        <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mt-2">
                        <label class="form-label" for="">Password</label>
                        <input class="form-control"  type="passsword" name="password" id="">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>