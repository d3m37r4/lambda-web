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
                    <a class="btn btn-primary" href="{{ route('admin.servers.show', $server) }}">
                        <i class="fas fa-reply"></i>
                        {{ ('Назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.servers.reasons.update', [$server, $reason]) }}" method="POST">
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
                        {{ ('Длительность наказания') }}
                    </label>
                    <div class="col-md-6">
                        <div class="input-group d-flex flex-nowrap">
                            <div class="form-outline">
                                <input id="months" class="form-control @error('months') is-invalid @enderror"
                                       name="months" type="number" min="0"
                                       value="{{ $reason->getTimeSpecialFormatted('%m') }}" required>
                                <label for="months" class="form-label">Месяцы</label>
                            </div>
                            <div class="form-outline">
                                <input id="days" class="form-control @error('days') is-invalid @enderror"
                                       name="days" type="number" min="0"
                                       value="{{ $reason->getTimeSpecialFormatted('%d') }}" required>
                                <label for="days" class="form-label">Дни</label>
                            </div>
                            <div class="form-outline">
                                <input id="hours" class="form-control @error('hours') is-invalid @enderror"
                                       name="hours" type="number" min="0"
                                       value="{{ $reason->getTimeSpecialFormatted('%h') }}" required>
                                <label for="hours" class="form-label">Часы</label>
                            </div>
                            <div class="form-outline">
                                <input id="minutes" class="form-control @error('minutes') is-invalid @enderror"
                                       name="minutes" type="number" min="0"
                                       value="{{ $reason->getTimeSpecialFormatted('%i') }}" required>
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
                               name="created" value="{{ $reason->created_at }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ $reason->updated_at }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-upd', ['title' => 'Обновить причину'])
                </div>
            </form>
        </div>
    </div>
@endsection
