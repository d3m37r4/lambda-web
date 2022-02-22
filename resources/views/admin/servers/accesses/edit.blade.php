@extends('layouts.admin-layout')

@section('title', "Редактирование доступа: $access->key")

@section('admin.content')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-file-alt"></i>
                        {{ ("Редактирование доступа: $access->key") }}
                    </h5>
                </div>
                <div class="d-grid">
                    <a class="btn btn-primary" href="{{ route('admin.servers.show', $server) }}">
                        <i class="fas fa-reply"></i>
                        {{ ('Назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.servers.accesses.update', [$server, $access]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group mb-3">
                    <label for="index" class="col-md-4 col-form-label text-sm-end">
                        {{ ('ID') }}
                    </label>
                    <div class="col-md-6">
                        <input id="index" type="text" class="form-control"
                               name="index" value="{{ $access->id }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="key" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Ключ доступа') }}
                    </label>
                    <div class="col-md-6">
                        <input id="key" type="text" class="form-control @error('key') is-invalid @enderror"
                               name="key" value="{{ old('key', $access->key) }}" required>
                        @include('components.field-filling-error', ['error' => 'key'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="description" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Ключ доступа') }}
                    </label>
                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                               name="description" value="{{ old('description', $access->description) }}" required>
                        @include('components.field-filling-error', ['error' => 'description'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Доступ добавлен') }}
                    </label>
                    <div class="col-md-6">
                        <input id="created" type="text" class="form-control"
                               name="created" value="{{ $access->created_at }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ $access->updated_at }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-upd', ['title' => 'Обновить доступ'])
                </div>
            </form>
        </div>
    </div>
@endsection
