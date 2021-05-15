@extends('layouts.admin-layout')

@section('title', 'Редактирование сервера')

@section('admin.content')
    @include('admin.components.alert')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-pencil-square"></i>
                        {{ ('Редактирование сервера: ') }} {{ $server->name }}
                    </h5>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.servers.index') }}">
                        <i class="bi bi-arrow-90deg-left"></i>
                        {{ ('Вернуться назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.servers.update', $server->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group mb-3">
                    <label for="name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Имя сервера') }}
                    </label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name', $server->name) }}" required>
                        @include('components.field-filling-error', ['error' => 'name'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="ip" class="col-md-4 col-form-label text-sm-end">
                        {{ ('IP') }}
                    </label>
                    <div class="col-md-6">
                        <input id="ip" type="text" class="form-control @error('ip') is-invalid @enderror"
                               name="ip" value="{{ old('ip', $server->ip) }}" required>
                        @include('components.field-filling-error', ['error' => 'ip'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="port" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Порт') }}
                    </label>
                    <div class="col-md-6">
                        <input id="port" type="text" class="form-control @error('port') is-invalid @enderror"
                               name="port" value="{{ old('port', $server->port) }}" required>
                        @include('components.field-filling-error', ['error' => 'port'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="rcon" class="col-md-4 col-form-label text-sm-end">
                        {{ ('RCON пароль') }}
                    </label>
                    <div class="col-md-6">
                        <input id="rcon" type="text" class="form-control @error('rcon') is-invalid @enderror"
                               name="rcon" value="{{ old('rcon', $server->rcon) }}"
{{--                               placeholder="{{ 'Введите RCON пароль' }}"--}}
                        >
                        @include('components.field-filling-error', ['error' => 'rcon'])
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
