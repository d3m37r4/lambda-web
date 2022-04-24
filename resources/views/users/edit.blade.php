@extends('layouts.main-content-layout')

@section('title', "Редактирование профиля: $user->name")

@section('main.content')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user-edit"></i>
                        {{ ("Редактирование профиля: $user->name") }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('components.link-back', ['redirect_route' => ['users.show', $user]])
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group mb-3 align-items-center">
                    <label for="name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Логин') }}
                    </label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control"
                               name="name" value="{{ $user->name }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="email" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Эл. почта') }}
                    </label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email', $user->email) }}" required>
                        @include('components.field-filling-error', ['error' => 'email'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="password" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Пароль') }}
                    </label>
                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password">
                        @include('components.field-filling-error', ['error' => 'password'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="password-confirm" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Подтверждение пароля') }}
                    </label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation">
                        @include('components.field-filling-error', ['error' => 'password_confirmation'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label class="col-md-4 col-form-label text-sm-end">
                        {{ ('Роль') }}
                    </label>
                    <div class="col-md-6">
                        <span class="badge bg-primary">{{ $user->role_name }}</span>
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="full_name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Полное имя') }}
                    </label>
                    <div class="col-md-6">
                        <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror"
                               name="full_name" value="{{ $user->full_name }}">
                        @include('components.field-filling-error', ['error' => 'full_name'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="gender" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Пол') }}
                    </label>
                    <div class="col-md-6">
                        @foreach ($genders as $gender)
                        <div class="form-check form-check-inline">
                            <input id="gender" type="radio" class="form-check-input"
                                   name="gender" @if (isset($user) && $user->gender === $gender) checked @endif>
                            <label class="form-check-label" for="gender">{{ $gender }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="date_of_birth" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Дата рождения') }}
                    </label>
                    <div class="col-md-6">
                        <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                               name="date_of_birth" value="{{ $user->date_of_birth }}">
                        @include('components.field-filling-error', ['error' => 'date_of_birth'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="country" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Страна') }}
                    </label>
                    <div class="col-md-6">
                        <select id="country" class="form-select @error('country') is-invalid @enderror"
                                name="country" size="4">
                            <option disabled>{{ ('Выберите страну...') }}</option>--}}
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                    @if (isset($user) && $user->country_id === $country->id) selected @endif>
                                {{ __('countries.'.$country->short_code) }}
                            </option>
                            @endforeach
                        </select>
                        @include('components.field-filling-error', ['error' => 'country'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="biography" class="col-md-4 col-form-label text-sm-end">
                        {{ ('О себе') }}
                    </label>
                    <div class="col-md-6">
                        <div class="form-outline">
                            <textarea class="form-control" id="biography" rows="4">{{ $user->biography }}</textarea>
                            <label class="form-label" for="biography">Введите текст</label>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Зарегистрирован') }}
                    </label>
                    <div class="col-md-6">
                        <input id="created" type="text" class="form-control"
                               name="created" value="{{ $user->created_at }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-upd', ['title' => 'Обновить пользователя'])
                </div>
            </form>
        </div>
    </div>
@endsection
