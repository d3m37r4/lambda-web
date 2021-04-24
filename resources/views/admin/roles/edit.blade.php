@extends('layouts.admin-layout')

@section('title', 'Редактирование роли')

@section('admin.content')
    @include('admin.components.alert')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-pencil-square"></i>
                        {{ ('Редактирование роли: ') }} {{ $role->name }}
                    </h5>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.index') }}">
                        <i class="bi bi-arrow-90deg-left"></i>
                        {{ ('Вернуться назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                                        @if (isset($role) && $role->hasPermissionTo($permission)) selected @endif>
                                    {{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text" id="permissionsHelp">
                            {{ ('Вы можете назначить одновременно несколько разрешений для одной роли.') }}
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-save"></i>
                        <span class="ml-1">{{ ('Обновить') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
