@extends('layouts.admin-layout')

@section('title', 'Новый пользователь')

@section('admin.content')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-person-plus-fill"></i>
                        {{ 'Новый пользователь' }}
                    </h5>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-arrow-90deg-left"></i>
                        {{ ('Вернуться назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row form-group mb-3">
                    <label for="name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Имя пользователя') }}
                    </label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" placeholder="{{ 'Введите имя пользователя' }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="email" class="col-md-4 col-form-label text-sm-end">
                        {{ ('E-Mail') }}
                    </label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" placeholder="{{ 'Введите E-mail' }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="password" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Пароль') }}
                    </label>
                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" placeholder="{{ 'Введите пароль' }}" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Подтверждение пароля') }}
                    </label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" placeholder="{{ 'Подтвердите пароль' }}" required>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-person-plus-fill"></i>
                        <span class="ml-1">{{ ('Создать пользователя') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
