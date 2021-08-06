@extends('layouts.admin-layout')

@section('title', "Добавление причины наказания")

@section('admin.content')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-file-medical"></i>
                        {{ ("Добавление причины наказания") }}
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
            <form action="{{ route('admin.servers.reasons.store', $server->id) }}" method="POST">
                @csrf
                <div class="row form-group mb-3">
                    <label for="title" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Название причины') }}
                    </label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" placeholder="{{ 'Введите название причины' }}" required>
                        @include('components.field-filling-error', ['error' => 'title'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="time" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Длительность наказания') }}
                    </label>
                    <div class="col-md-6">
                        <input id="time" type="number" class="form-control @error('time') is-invalid @enderror"
                               name="time" placeholder="{{ 'Введите время' }}" required>
                        @include('components.field-filling-error', ['error' => 'time'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Добавлена') }}
                    </label>
                    <div class="col-md-6">
                        <input id="created" type="text" class="form-control"
                               name="created" value="{{ $createdTime }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ $createdTime }}" disabled>
                    </div>
                </div>
                <div>
                    @include('admin.components.btn-add', ['title' => 'Добавить причину наказания'])
                </div>
            </form>
        </div>
    </div>
@endsection
