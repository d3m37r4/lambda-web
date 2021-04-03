@extends('layouts.admin-layout')

@section('title', 'Редактирование пользователя')

@section('admin.content')
    @include('admin.components.alert')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-pencil-square"></i>
                        {{ ('Редактирование пользователя: ') }} {{ $user->name }}
                    </h5>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-reply"></i>
                        {{ ('Вернуться назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group mb-3">
                    <label for="name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Имя пользователя') }}
                    </label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name', $user->name) }}" required>
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
                               name="email" value="{{ old('email', $user->email) }}" required>
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
                               name="password">
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
                               name="password_confirmation">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-save"></i>
                        <span class="ml-1">{{ ('Обновить') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
