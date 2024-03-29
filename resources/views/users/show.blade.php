@extends('layouts.main-content-layout')

@section('title', "Профиль пользователя $user->login")

@section('main.content')
<div class="card shadow-2 border">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between">
            <div class="me-auto align-self-center">
                <h5 class="card-title m-0">
                    <i class="fas fa-user"></i>
                    {{ ("Профиль пользователя $user->login") }}
                </h5>
            </div>
            <div class="d-grid">
            @can('update', $user)
                <div>
                    <a class="btn btn-primary"
                       data-mdb-toggle="tooltip"
                       href="{{ route('users.edit', $user) }}">
                        <i class="fas fa-pen"></i>
                        {{ ('Редактировать профиль') }}
                    </a>
                </div>
            @endcan
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="mb-3">
                        <i class="fas fa-user fa-10x"></i>
                    </div>
                    <div>
                        @include('components.role-badge', ['role' => $user->role_name])
                        @if($user->isCountrySpecified())
                        <p class="text-muted">{{ __($user->country()) }}</p>
                        @endif
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ ('Имя') }}</span>
                        <span>{{ ('Имя') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ ('Фамилия') }}</span>
                        <span>{{ ('Фамилия') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ ('Возраст') }}</span>
                        <span>{{ $user->age }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ ('Дата рождения') }}</span>
                        <span>{{ $user->birth_date_fmt }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{ __('genders.gender') }}</span>
                        <span>{{ __("genders.list.$user->gender") }}</span>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul class="nav nav-tabs nav-fill border-bottom mb-3" id="ex1">
                    <li class="nav-item">
                        <a class="nav-link active" href="#info" data-mdb-toggle="tab"
                           aria-controls="info" aria-selected="true">
                            {{ ('Общая информация') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services" data-mdb-toggle="tab"
                           aria-controls="services" aria-selected="false">
                            {{ ('Сервисы') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#permissions" data-mdb-toggle="tab"
                            aria-controls="permissions" aria-selected="false">
                            {{ ('Доступные разрешения') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#accounts" data-mdb-toggle="tab"
                            aria-controls="accounts" aria-selected="false">
                            {{ ('Игровые аккаунты') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="ex1-content">
                    <div class="tab-pane fade show active" id="info" aria-labelledby="info">
                        {{ ('Эл. почта:') }}
                        <a class="link-primary"
                           data-mdb-toggle="tooltip"
                           title="Email {{ $user->email }}"
                           href="mailto:{{ $user->email }}">
                            {{ $user->email }}
                        </a> <br />
                        {{ ("Дата регистрации: $user->created_at") }}<br />
                        {{ ("Последнее обновление профиля: $user->updated_at") }}<br />
                        {{ ("О себе: $user->biography") }}
                    </div>
                    <div class="tab-pane fade" id="services" aria-labelledby="services">
                        {{ ('Вы можете присоединить дополнительные сервисы для авторизации на сайте') }}
                    </div>
                    <div class="tab-pane fade" id="permissions" aria-labelledby="permissions">
                        Доступы
                    </div>
                    <div class="tab-pane fade" id="accounts" aria-labelledby="accounts">
                        Игровые аккаунты
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
