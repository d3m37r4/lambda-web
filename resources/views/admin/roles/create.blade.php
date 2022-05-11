@extends('layouts.admin-layout')

@section('title', 'Новая роль')

@section('admin.content')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user-shield"></i>
                        {{ 'Новая роль' }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('components.link-back', ['redirect_route' => 'admin.roles.index'])
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="row form-group mb-3">
                    <label for="name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Имя роли') }}
                    </label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" placeholder="{{ 'Введите имя новой роли' }}" required>
                        @include('components.field-filling-error', ['error' => 'name'])
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="permissions" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Разрешения') }}
                    </label>
                    <div class="col-md-6">
                        <select id="permissions" class="form-select @error('permissions') is-invalid @enderror"
                                name="permissions[]" size="6" aria-describedby="permissionsHelp" multiple>
                            <option disabled>{{ ('Назначьте разрешения для новой роли...') }}</option>
                            @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text" id="permissionsHelp">
                            {{ ('Вы можете назначить одновременно несколько разрешений для одной роли.') }}
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="created" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Роль добавлена') }}
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
                    @include('admin.components.btn-add', ['title' => 'Добавить роль'])
                </div>
            </form>
        </div>
    </div>
@endsection
