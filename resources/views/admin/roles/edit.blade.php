@extends('layouts.admin-layout')

@section('title', "Редактирование роли: $role->name")

@section('admin.content')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-shield-alt"></i>
                        {{ ("Редактирование роли: $role->name") }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('components.link-back', ['redirect_route' => 'admin.roles.index'])
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row form-group mb-3">
                    <label for="index" class="col-md-4 col-form-label text-sm-end">
                        {{ ('ID') }}
                    </label>
                    <div class="col-md-6">
                        <input id="index" type="text" class="form-control"
                               name="index" value="{{ $role->id }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="name" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Имя роли') }}
                    </label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name', $role->name) }}" required>
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
                            <option disabled>{{ ('Назначьте разрешения для роли...') }}</option>
                            @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}"
                                    @if(isset($role) && $role->hasPermissionTo($permission)) selected @endif>
                                {{ $permission->name }}
                            </option>
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
                               name="created" value="{{ $role->created_at }}" disabled>
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="updated" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Последнее обновление') }}
                    </label>
                    <div class="col-md-6">
                        <input id="updated" type="text" class="form-control"
                               name="updated" value="{{ $role->updated_at }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    @include('admin.components.btn-upd', ['title' => 'Обновить роль'])
                </div>
            </form>
        </div>
    </div>
@endsection
