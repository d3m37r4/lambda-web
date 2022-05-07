@extends('layouts.admin-layout')

@section('title', "Профиль пользователя $user->login")

@section('admin.content')
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
                    @include('components.link-back', ['redirect_route' => 'admin.users.index'])
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center text-center border-bottom pb-3">
                        <i class="fas fa-user fa-10x"></i>
                        <div class="mt-3">
                            <p class="text-secondary mb-1">
                                <span class="badge bg-primary">{{ $user->role_name }}</span>
                            </p>
                            <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span style="color:#202020;">
                                <i class="fab fa-steam fa-lg"></i>
                            </span>
                            <span class="text-secondary">bootdey</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span style="color:#2787F5;">
                                <i class="fab fa-vk fa-lg"></i>
                            </span>
                            <span class="text-secondary">
                                bootdey
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <span style="color:#0088cc;">
                                <i class="fab fa-telegram fa-lg"></i>
                            </span>
                            <span class="text-secondary">bootdey</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="pb-3">
                        <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="#ex1-tabs-1" id="ex1-tab-1" data-mdb-toggle="tab"
                                   role="tab" aria-controls="ex1-tabs-1" aria-selected="true">
                                    {{ ('Общая информация') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#ex1-tabs-2" id="ex1-tab-2" data-mdb-toggle="tab"
                                    role="tab" aria-controls="ex1-tabs-2" aria-selected="false">
                                    {{ ('Доступные разрешения') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#ex1-tabs-3" id="ex1-tab-3" data-mdb-toggle="tab"
                                    role="tab" aria-controls="ex1-tabs-3" aria-selected="false">
                                    {{ ('Игровые аккаунты') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                 aria-labelledby="ex1-tab-1">
                                Имя: {{ $user->login }} <br />
                                Фамилия: {{ $user->login }} <br />
                                UserID: {{ $user->id }} <br />
                                Эл. почта: <a class="link-primary"
                                   data-mdb-toggle="tooltip"
                                   title="Email {{ $user->email }}"
                                   href="mailto:{{ $user->email }}">
                                    {{ $user->email }}
                                </a> <br />
                                Зарегистрирован: {{ $user->created_at }} <br />
                                Последнее обновление профиля: {{ $user->updated_at }} <br />
                            </div>
                            <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                @foreach($permissions as $permission)
                                <span class="badge bg-primary">{{ $permission->name }} </span><br />
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                                Игровые аккаунты
                            </div>
                        </div>
                    </div>
{{--                    <div class="row">--}}
{{--                        <div>--}}
{{--                            .div--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            .div--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            .col-md-6--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            .col-md-6--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
