<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
    data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="{{ config('app.url') }}"><span class="fas fa-brain me-1">
            </span>{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest()
                    <li class="nav-item">
                        <a class="{{ (Route::is('login')) ? 'active' : '' }} nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (Route::is('register')) ? 'active' : '' }} nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
                @auth()
                    @if (Auth::user()->is_admin)
                    <li class="nav-item">
                        <a class="{{ (Route::is('admin.dashboard')) ? 'active' : '' }} nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="{{ (Route::is('profile')) ? 'active' : '' }} nav-link" href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit"> Logout </button>
                            {{-- <a class="nav-link" href="{{ config('app.url')}}/logout">LogOut</a> --}}
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
