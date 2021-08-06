@extends('layouts.admin-layout')

@section('title', "Редактирование причины: $reason->title")

@section('admin.content')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-file-alt"></i>
                        {{ ("Редактирование причины: $reason->title") }}
                    </h5>
                </div>
                <div class="d-grid">
                    <a class="btn btn-primary" href="{{ route('admin.servers.show', $server->id) }}">
                        <i class="fas fa-reply"></i>
                        {{ ('Назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.servers.reasons.update', [$server->id, $reason->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group mb-3">
                    <label for="index" class="col-md-4 col-form-label text-sm-end">
                        {{ ('ID') }}
                    </label>
                    <div class="col-md-6">
                        <input id="index" type="text" class="form-control"
                               name="index" value="{{ $reason->id }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="title" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Название причины') }}
                    </label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title', $reason->title) }}" required>
                        @include('components.field-filling-error', ['error' => 'title'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="time" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Время наказания') }}
                    </label>
                    <div class="col-md-6">
                        <input id="time" type="number" class="form-control @error('time') is-invalid @enderror"
                               name="time" value="{{ old('time', $reason->time) }}" required>
                        @include('components.field-filling-error', ['error' => 'time'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Добавлена') }}
                    </label>
                    <div class="col-md-6">
                        <input id="created" type="text" class="form-control"
                               name="created" value="{{ $reason->created_at->format('d.m.Y - H:i:s') }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ $reason->updated_at->format('d.m.Y - H:i:s') }}" disabled>
                    </div>
                </div>
                <div>
                    @include('admin.components.btn-upd', ['title' => 'Обновить'])
                </div>
            </form>
        </div>
    </div>
@endsection
