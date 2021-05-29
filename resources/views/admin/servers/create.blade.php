@extends('layouts.admin-layout')

@section('title', 'Новый сервер')

@section('admin.content')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-shield-plus"></i>
                        {{ 'Новый сервер' }}
                    </h5>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.servers.index') }}">
                        <i class="bi bi-reply"></i>
                        {{ ('Вернуться назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.servers.store') }}" method="POST">
                @csrf
                <div class="row form-group mb-3">
                    <label for="name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Имя сервера') }}
                    </label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" placeholder="{{ 'Введите имя сервера' }}" required>
                        @include('components.field-filling-error', ['error' => 'name'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="ip" class="col-md-4 col-form-label text-sm-end">
                        {{ ('IP') }}
                    </label>
                    <div class="col-md-6">
                        <input id="ip" type="text" class="form-control @error('ip') is-invalid @enderror"
                               name="ip" placeholder="{{ 'Введите ип адрес' }}" required>
                        @include('components.field-filling-error', ['error' => 'ip'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="port" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Порт') }}
                    </label>
                    <div class="col-md-6">
                        <input id="port" type="text" class="form-control @error('port') is-invalid @enderror"
                               name="port" placeholder="{{ 'Введите порт' }}" required>
                        @include('components.field-filling-error', ['error' => 'port'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="rcon" class="col-md-4 col-form-label text-sm-end">
                        {{ ('RCON пароль') }}
                    </label>
                    <div class="col-md-6">
                        <input id="rcon" type="text" class="form-control @error('rcon') is-invalid @enderror"
                               name="rcon" placeholder="{{ 'Введите RCON пароль' }}">
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
                                   name="token" aria-describedby="tokenHelp" readonly>
                            <button class="btn btn-outline-success" id="copyToken"
                                    title="{{ ('Скопировать токен в буфер обмена') }}">
                                <i class="far fa-clone"></i>
                            </button>
                            <button class="btn btn-outline-primary" id="refreshToken"
                                    title="{{ ('Обновить токен') }}">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="form-text" id="tokenHelp">
                            {{ ('Запишите данный токен в поле "token" файлa "lambda-core.json" на сервере.') }}
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-shield-plus"></i>
                        <span class="ml-1">{{ ('Добавить новый сервер') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('secondary-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let tokenForm = document.querySelector("#token");
            generateToken(tokenForm, tokenLength);

            document.getElementById('refreshToken')
                .addEventListener('click', () => generateToken(tokenForm, tokenLength));

            let copyText = document.getElementById('copyToken');
            copyText.addEventListener('click', function () {
                console.log('ТЕКСТ');
                copyText.select();
                document.execCommand("copy");
                alert("Copied the text: " + copyText.value);
            });
        });

    </script>
@endpush
