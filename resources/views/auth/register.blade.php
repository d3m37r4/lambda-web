@extends('layouts.main-content-layout')

@section('title', 'Регистрация')

@section('main.content')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user-plus"></i>
                        {{ ('Регистрация') }}
                    </h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row form-group mb-3 align-items-center">
                    <label for="login" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Логин') }}
                    </label>
                    <div class="col-md-6">
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror"
                               name="login" value="{{ old('login') }}" required autocomplete="login">
                        @include('components.field-filling-error', ['error' => 'login'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="email" class="col-md-4 col-form-label text-sm-end">
                        {{ ('E-Mail') }}
                    </label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email">
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
                               name="password" required autocomplete="new-password">
                        @include('components.field-filling-error', ['error' => 'password'])
                    </div>
                </div>
                <div class="row form-group mb-3 align-items-center">
                    <label for="password-confirm" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Подтвердите пароль') }}
                    </label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                        @include('components.field-filling-error', ['error' => 'password_confirmation'])
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-success">{{ ('Зарегистрироваться') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
