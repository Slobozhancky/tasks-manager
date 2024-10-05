<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex w-100">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>

                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ auth()->user()->name . ' ' . auth()->user()->role }}</a>
                        </li>

                        <!-- Контейнер для кнопки, яка вирівняна вправо -->
                        <li class="nav-item ms-auto">
                            <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registration') }}">Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                @endif
            </ul>

        </div>
    </div>
</nav>

<main>
    <div class="container">
        @yield('registration')
        @yield('login')
        @yield('dashboard')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
