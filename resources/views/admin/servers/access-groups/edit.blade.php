@extends('layouts.admin-layout')

@section('title', "Редактирование группы доступов: $accessGroup->title")

@section('admin.content')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-file-alt"></i>
                        {{ ("Редактирование группы доступов: $accessGroup->title") }}
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
            <form action="{{ route('admin.servers.access-groups.update', [$server, $accessGroup]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group mb-3">
                    <label for="index" class="col-md-4 col-form-label text-sm-end">
                        {{ ('ID') }}
                    </label>
                    <div class="col-md-6">
                        <input id="index" type="text" class="form-control"
                               name="index" value="{{ $accessGroup->id }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="title" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Название группы доступов') }}
                    </label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title', $accessGroup->title) }}" required>
                        @include('components.field-filling-error', ['error' => 'title'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="flags" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Набор флагов') }}
                    </label>
                    <div class="col-md-6">
                        <input id="flags" type="text" class="form-control @error('flags') is-invalid @enderror"
                               name="flags" value="{{ old('flags', $accessGroup->flags) }}" required>
                        @include('components.field-filling-error', ['error' => 'flags'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="prefix" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Префикс') }}
                    </label>
                    <div class="col-md-6">
                        <input id="prefix" type="text" class="form-control @error('prefix') is-invalid @enderror"
                               name="prefix" value="{{ old('prefix', $accessGroup->prefix) }}" required>
                        @include('components.field-filling-error', ['error' => 'prefix'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Доступ добавлен') }}
                    </label>
                    <div class="col-md-6">
                        <input id="created" type="text" class="form-control"
                               name="created" value="{{ $accessGroup->created_at }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ $accessGroup->updated_at }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-upd', ['title' => 'Обновить группу доступов'])
                </div>
            </form>
        </div>
    </div>
@endsection
