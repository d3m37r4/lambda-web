<!-- Fixed navbar -->
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <div class="container-xxl">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="btn btn-sm btn-outline-light" href="{{ route('login') }}">Войти</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Зарегистрироваться</a>
                    @endif
                @else
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <h6 class="dropdown-header">Dropdown header</h6>
{{--                                <span class="dropdown-item-text badge badge-info">--}}
                                <span class="dropdown-item-text">
                                    {{ Auth::user()->getRoleNames()->first() }}
                                </span>
                                <div class="dropdown-divider"></div>
{{--                                            @can('enter_control_panel')--}}
{{--                                                <a class="dropdown-item" href="{{ route('admin.index') }}">--}}
{{--                                                    {{ __('main.control_panel') }}--}}
{{--                                                </a>--}}
{{--                                            @endcan--}}
{{--                                            <a class="dropdown-item" href="{{ route('admin.index') }}">{{ ('Профиль пользователя') }}</a>--}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ ('Выход') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </div>
</nav>
