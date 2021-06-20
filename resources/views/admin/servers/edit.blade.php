@extends('layouts.admin-layout')

@section('title', 'Редактирование сервера')

@section('admin.content')
    @include('admin.components.alert')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="fas fa-server"></i>
                        {{ ('Редактирование сервера: ') }} {{ $server->name }}
                    </h5>
                </div>
                <div>
                    @include('admin.components.link-back',
                        ['title' => 'Вернуться назад', 'route' => 'admin.servers.index'])
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
                                @isset($server->rcon)
                                    value="{{ old('rcon', $server->rcon) }}"
                                @else
                                    placeholder="{{ 'Введите RCON пароль' }}"
                                @endisset
                               name="rcon">
                        @include('components.field-filling-error', ['error' => 'rcon'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="token" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Токен авторизации') }}
                    </label>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input id="token" type="text" class="form-control"
                                   name="auth_token" aria-describedby="tokenHelp"
                                   readonly>
                            <button type="button" class="btn btn-outline-success" id="copyToken"
                                    title="{{ ('Скопировать токен в буфер обмена') }}">
                                <i class="far fa-clone"></i>
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="refreshToken"
                                    title="{{ ('Сгенерировать новый токен') }}">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="form-text" id="tokenHelp">
                            {{ ('Запишите данный токен в поле "token" файлa "lambda-core.json" на сервере.') }}
                            {{ ('Токен хранится в базе данных в зашифрованном виде. Если Вы утратили токен, необходимо сгенерировать новый.') }}
                        </div>
                    </div>
                </div>
                <div>
                    @include('admin.components.btn-upd', ['title' => 'Обновить'])
                </div>
            </form>
        </div>
    </div>
@endsection

@push('secondary-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let tokenForm = document.querySelector("#token");
            document.getElementById('refreshToken')
                .addEventListener('click', () => generateToken(tokenForm, tokenLength));

            document.getElementById('copyToken')
                .addEventListener('click', function () {
                    tokenForm.select();
                    document.execCommand("copy");
                });
        });
    </script>
@endpush
