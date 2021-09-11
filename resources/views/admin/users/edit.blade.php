@extends('layouts.admin-layout')

@section('title', 'Редактирование пользователя')

@section('admin.content')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user-edit"></i>
                        {{ ('Редактирование пользователя: ') }} {{ $user->name }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('admin.components.link-back', ['link' => $redirect, 'title' => 'Назад'])
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
                        @include('components.field-filling-error', ['error' => 'name'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="email" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Эл. почта') }}
                    </label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email', $user->email) }}" required>
                        @include('components.field-filling-error', ['error' => 'email'])
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
                        @include('components.field-filling-error', ['error' => 'password'])
                    </div>
                </div>
                <div class="row form-group mb-3">
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
                <div class="row form-group mb-3">
                    <label for="role" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Роль пользователя') }}
                    </label>
                    <div class="col-md-6">
                        <select id="role" class="form-control form-select @error('role') is-invalid @enderror"
                                name="role" size="6">
                            <option disabled>{{ ('Назначьте роль пользователю...') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                        @if (isset($user) && $user->hasRole($role)) selected @endif>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @include('components.field-filling-error', ['error' => 'role'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Пользователь добавлен') }}
                    </label>
                    <div class="col-md-6">
                        <input id="created" type="text" class="form-control"
                               name="created" value="{{ $user->created_at->format('d.m.Y - H:i:s') }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ $user->updated_at->format('d.m.Y - H:i:s') }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-upd', ['title' => 'Обновить пользователя'])
                </div>
            </form>
        </div>
    </div>
@endsection
