@extends('layouts.admin-layout')

@section('title', 'Профиль пользователя')

@section('admin.content')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user-edit"></i>
                        {{ ('Профиль пользователя: ') }} {{ $user->name }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('admin.components.link-back', ['link' => $redirect, 'title' => 'Назад'])
                </div>
            </div>
        </div>
        <div class="card-body">
            Имя пользователя: {{ $user->name }} <br />
            UserID: {{ $user->id }} <br />
            Роль:  <span class="badge bg-primary">{{ $user->getRoleNames()->first() }}</span> <br />
            <button class="btn btn-primary" type="button" data-mdb-toggle="collapse" data-mdb-target="#showPermissions" aria-expanded="false" aria-controls="showPermissions">
                Показать разрешения пользователя
            </button>

            <div class="collapse" id="showPermissions">
                @foreach($permissions as $permission)
                    <span class="badge bg-primary">{{ $permission->name }} </span><br />
                @endforeach
            </div>
            <br />
            Эл. почта: <a class="link-primary"
               data-mdb-toggle="tooltip"
               title="Email {{ $user->email }}"
               href="mailto:{{ $user->email }}">
                {{ $user->email }}
            </a> <br />
            Зарегистрирован: {{ $user->created_at }} <br />
            Последнее обновление профиля: {{ $user->updated_at }} <br />
            <!-- Facebook -->
            <a class="btn btn-primary" style="background-color: #3b5998;" href="#!" role="button"
            ><i class="fab fa-facebook-f"></i
                ></a>

            <!-- Twitter -->
            <a class="btn btn-primary" style="background-color: #55acee;" href="#!" role="button"
            ><i class="fab fa-twitter"></i
                ></a>

            <!-- Google -->
            <a class="btn btn-primary" style="background-color: #dd4b39;" href="#!" role="button"
            ><i class="fab fa-google"></i
                ></a>

            <!-- Instagram -->
            <a class="btn btn-primary" style="background-color: #ac2bac;" href="#!" role="button"
            ><i class="fab fa-instagram"></i
                ></a>

            <!-- Vkontakte -->
            <a class="btn btn-primary" style="background-color: #4c75a3;" href="#!" role="button"
            ><i class="fab fa-vk"></i
                ></a>

            <!-- Whatsapp -->
            <a class="btn btn-primary" style="background-color: #25d366;" href="#!" role="button"
            ><i class="fab fa-whatsapp"></i
                ></a>
        </div>
    </div>
@endsection
