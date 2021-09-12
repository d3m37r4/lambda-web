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
                    <a class="btn btn-primary" href="{{ route('admin.servers.show', $server) }}">
                        <i class="fas fa-reply"></i>
                        {{ ('Назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.servers.reasons.store', $server) }}" method="POST">
                @csrf
                <div class="row form-group mb-3">
                    <label for="title" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Название причины') }}
                    </label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" value="{{ old('title') }}"
                               placeholder="{{ 'Введите название причины' }}" required>
                        @include('components.field-filling-error', ['error' => 'title'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="time" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Длительность наказания') }}
                    </label>
                    <div class="col-md-6">
                        <div class="input-group d-flex flex-nowrap">
                            <div class="form-outline">
                                <input id="months" class="form-control @error('months') is-invalid @enderror"
                                       name="months" type="number" min="0" value="{{ old('months', 0) }}" required>
                                <label for="months" class="form-label">Месяцы</label>
                            </div>
                            <div class="form-outline">
                                <input id="days" class="form-control @error('days') is-invalid @enderror"
                                       name="days" type="number" min="0" value="{{ old('days', 0) }}" required>
                                <label for="days" class="form-label">Дни</label>
                            </div>
                            <div class="form-outline">
                                <input id="hours" class="form-control @error('hours') is-invalid @enderror"
                                       name="hours" type="number" min="0" value="{{ old('hours', 0) }}" required>
                                <label for="hours" class="form-label">Часы</label>
                            </div>
                            <div class="form-outline">
                                <input id="minutes" class="form-control @error('minutes') is-invalid @enderror"
                                       name="minutes" type="number" min="0" value="{{ old('minutes', 0) }}" required>
                                <label for="minutes" class="form-label">Минуты</label>
                            </div>
                        </div>
                        <div class="form-text">
                            {{ ('Оставьте все значения равными нулю для указания бессрочного действия.') }}
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Причина добавлена') }}
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
                    @include('admin.components.btn-add', ['title' => 'Добавить причину'])
                </div>
            </form>
        </div>
    </div>
@endsection
