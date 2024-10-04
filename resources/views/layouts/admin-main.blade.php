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
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.index') }}">Admin panel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.users.index') }}">Users</a>
                </li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <li>
                        <button type="submit" class="nav-link" style="background: none; border: none; color: inherit; cursor: pointer;">
                            Logout
                        </button>
                    </li>
                </form>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="container">
        @yield('admin-index')
        @yield('users')
        @yield('edit-user')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
