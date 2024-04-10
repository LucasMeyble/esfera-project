<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vue.global.js')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    @if (auth()->check())
        <nav class="navbar navbar-expand-lg bg-light navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{route('tasks.index')}}">TODO LIST</a>
                <div class=" " id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link mx-2 fw-bolder d-flex justify-content-between align-items-center" href="{{route('auth.destroy')}}">LOGOUT<span style="font-size: 20px;" class="material-icons p-2">logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endif
    @if (session('success'))
        <div class="w-100 mt-5">
            <div class="row d-flex justify-content-center align-items-center w-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class=" alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (session('error'))
    <div class="w-100 mt-5">
        <div class="row d-flex justify-content-center align-items-center w-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class=" alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ( session('error') as $message)
                        {{$message}}<br/>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @yield('content')

    <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    @yield('script')
</body>
</html>
