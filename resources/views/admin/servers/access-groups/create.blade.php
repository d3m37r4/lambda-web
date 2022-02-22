@extends('layouts.admin-layout')

@section('title', 'Добавление группы доступов')

@section('admin.content')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-file-medical"></i>
                        {{ ('Добавление группы доступов') }}
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
            <form action="{{ route('admin.servers.access-groups.store', $server) }}" method="POST">
                @csrf
                <div class="row form-group mb-3">
                    <label for="title" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Название группы доступов') }}
                    </label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title') }}"
                               placeholder="{{ 'Введите название группы доступов' }}" required>
                        @include('components.field-filling-error', ['error' => 'title'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="flags" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Набор флагов') }}
                    </label>
                    <div class="col-md-6">
                        <input id="flags" type="text" class="form-control @error('flags') is-invalid @enderror"
                               name="flags" value="{{ old('flags') }}"
                               placeholder="{{ 'Добавьте флаги для группы доступа' }}" required>
                        @include('components.field-filling-error', ['error' => 'flags'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="prefix" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Префикс') }}
                    </label>
                    <div class="col-md-6">
                        <input id="prefix" type="text" class="form-control @error('prefix') is-invalid @enderror"
                               name="prefix" value="{{ old('prefix') }}"
                               placeholder="{{ 'Введите префикс группы доступов' }}" required>
                        @include('components.field-filling-error', ['error' => 'prefix'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Доступ добавлен') }}
                    </label>
                    <div class="col-md-6">
                        <input id="created" type="text" class="form-control"
                               name="created" value="{{ \Carbon\Carbon::now()->format('d.m.Y - H:i:s') }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ \Carbon\Carbon::now()->format('d.m.Y - H:i:s') }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-add', ['title' => 'Добавить группу доступов'])
                </div>
            </form>
        </div>
    </div>
@endsection
