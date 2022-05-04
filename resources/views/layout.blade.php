<html>
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/app.css">
</head>
<body>

<header>


@guest
        <nav class="navbar navbar-dark bg-dark text-light navbar-expand-lg">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-dd47e21793c3e4493d24a10e132c93db" aria-label="Toggle Menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse position-relative d-flex justify-content-between" id="navbar-dd47e21793c3e4493d24a10e132c93db">
                    <ul class="navbar-nav"></ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/register">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @else
        <nav class="navbar navbar-dark bg-dark text-light navbar-expand-lg">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-dd47e21793c3e4493d24a10e132c93db" aria-label="Toggle Menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse position-relative d-flex justify-content-between" id="navbar-dd47e21793c3e4493d24a10e132c93db">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/calendar">Calendar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/project">Projects</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">
                                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" class="mb-0" method="POST">
                                @csrf
                                <button class="nav-link">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endguest
</header>
    <div class="py-5">
        @yield('content')
    </div>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="/public/js/app.js"></script>

</body>
</html>
