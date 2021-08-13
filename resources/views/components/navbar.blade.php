<!-- Fixed navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container-xxl">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Банлист</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Статистика</a>
                </li>
            </ul>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                @guest
                    @if (Route::has('login'))
                        <a class="btn btn-sm btn-light" href="{{ route('login') }}">
                            {{ ('Вход') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-sm btn-primary" href="{{ route('register') }}">
                            {{ ('Регистрация') }}
                        </a>
                    @endif
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                               data-mdb-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li class="text-center">
                                    <h6 class="dropdown-header">
                                        {{ Auth::user()->name }}
                                    </h6>
                                </li>
                                <li class="text-center">
                                    <span class="badge bg-primary">
                                        {{ Auth::user()->getRoleNames()->first() }}
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li class="text-center">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-id-card"></i>
                                        {{ ('Профиль') }}
                                    </a>
                                </li>
                                @can('enter_control_panel')
                                    <li class="text-center">
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            <i class="fas fa-cogs"></i>
                                            {{ ('Панель управления') }}
                                        </a>
                                    </li>
                                @endcan
                                <li class="text-center">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-gamepad"></i>
                                        {{ ('Игровые аккаунты') }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li class="text-center">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ ('Выйти') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </div>
</nav>
