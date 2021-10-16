@extends('layouts.admin-layout')

@section('title', 'Настройки системы')

@section('admin.content')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-cogs"></i>
                        {{ ('Настройки системы') }}
                    </h5>
                </div>
                <div class="d-grid">
{{--                    @include('admin.components.link-add', ['route' => 'admin.servers.create', 'title' => 'Добавить'])--}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Tabs navs -->
                <ul class="nav nav-pills nav-fill mb-3" id="ex1">
                    <li class="nav-item">
                        <a class="nav-link active" data-mdb-toggle="tab" id="main-tab"
                           href="#main" aria-controls="main" aria-selected="true">
                            <i class="fas fa-cog"></i>
                            {{ ('Основные') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-mdb-toggle="tab" id="security-tab"
                           href="#security" aria-controls="security" aria-selected="false">
                            <i class="fas fa-umbrella"></i>
                            {{ ('Безопасность') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-mdb-toggle="tab" id="files-tab"
                           href="#files" aria-controls="files" aria-selected="false">
                            <i class="far fa-file-alt"></i>
                            {{ ('Файлы') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-mdb-toggle="tab" id="mail-tab"
                           href="#mail" aria-controls="mail" aria-selected="false">
                            <i class="fas fa-mail-bulk"></i>
                            {{ ('Почта') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-mdb-toggle="tab" id="users-tab"
                           href="#users" aria-controls="users" aria-selected="false">
                            <i class="fas fa-users-cog"></i>
                            {{ ('Пользователи') }}
                        </a>
                    </li>
                </ul>
                <!-- Tabs navs -->
                <!-- Tabs content -->
                <div class="tab-content" id="ex2-content">
                    <div class="tab-pane fade show active" id="main" aria-labelledby="main-tab">
                        <div class="row form-group mb-3">
                            <label for="name" class="col-md-4 col-form-label text-sm-end">
                                {{ ('Название сайта') }}
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', config('app.name')) }}">
                                @include('components.field-filling-error', ['error' => 'name'])
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="name" class="col-md-4 col-form-label text-sm-end">
                                {{ ('Домашняя страница сайта') }}
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('url') is-invalid @enderror"
                                       name="name" value="{{ old('url', config('app.url')) }}">
                                @include('components.field-filling-error', ['error' => 'url'])
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="name" class="col-md-4 col-form-label text-sm-end">
                                {{ ('Описание (Description) сайта') }}
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('description') is-invalid @enderror"
                                       name="name" value="{{ old('description', config('app.description')) }}">
                                @include('components.field-filling-error', ['error' => 'description'])
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="name" class="col-md-4 col-form-label text-sm-end">
                                {{ ('Часовой пояс') }}
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('timezone') is-invalid @enderror"
                                       name="name" value="{{ old('timezone', config('app.timezone')) }}">
                                @include('components.field-filling-error', ['error' => 'timezone'])
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="name" class="col-md-4 col-form-label text-sm-end">
                                {{ ('Используемый язык') }}
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('locale') is-invalid @enderror"
                                       name="name" value="{{ old('locale', config('app.locale')) }}">
                                @include('components.field-filling-error', ['error' => 'locale'])
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="security" aria-labelledby="security-tab">
                        <div class="row form-group mb-3">
                            <label for="admin_dir" class="col-md col-form-label text-sm-end">
                                {{ ('Название дирректории панели управления') }}
                            </label>
                            <div class="col-md-6">
                                <input id="admin_dir" type="text"
                                       class="form-control @error('admin_dir') is-invalid @enderror"
                                       name="admin_dir" value="{{ old('admin_dir', config('app.admin_dir')) }}">
                                @include('components.field-filling-error', ['error' => 'admin_dir'])
                            </div>
                        </div>
                        <div class="row form-group mb-3">
                            <label for="name" class="col-md col-form-label text-sm-end">
                                {{ ('Название дирректории панели управления') }}
                            </label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', config('app.name')) }}">
                                @include('components.field-filling-error', ['error' => 'name'])
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="files" aria-labelledby="files-tab">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" class="form-control" />
                            <label class="form-label" for="loginName">Field 1</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" class="form-control" />
                            <label class="form-label" for="loginName">Field 2</label>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="mail" aria-labelledby="mail-tab">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" class="form-control" />
                            <label class="form-label" for="loginName">Field 1</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" class="form-control" />
                            <label class="form-label" for="loginName">Field 2</label>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="users" aria-labelledby="users-tab">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" class="form-control" />
                            <label class="form-label" for="loginName">Field 1</label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="loginName" class="form-control" />
                            <label class="form-label" for="loginName">Field 2</label>
                        </div>
                    </div>
                </div>
                <!-- Tabs content -->
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-upd', ['title' => 'Сохранить изменения'])
                </div>
            </form>
        </div>
    </div>
@endsection
