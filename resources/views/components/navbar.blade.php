<!-- Fixed navbar -->
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <div class="container-xxl">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
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
                        <a class="btn btn-sm btn-outline-light me-md-2" href="{{ route('login') }}">
                            {{ ('Войти') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-sm btn-primary" href="{{ route('register') }}">
                            {{ ('Зарегистрироваться') }}
                        </a>
                    @endif
                @else
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="container">
                                        <span class="badge bg-primary">
                                            {{ Auth::user()->getRoleNames()->first() }}
                                        </span>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @can('enter_control_panel')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            <i class="bi bi-tools"></i>
                                            {{ ('Панель управления') }}
                                        </a>
                                    </li>
                                @endcan
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person-fill"></i>
                                        {{ ('Профиль') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-controller"></i>
                                        {{ ('Игровые аккаунты') }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i>
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
