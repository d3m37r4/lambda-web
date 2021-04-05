@extends('layouts.admin-layout')

@section('title', 'Новая роль')

@section('admin.content')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-shield-plus"></i>
                        {{ 'Новая роль' }}
                    </h5>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.index') }}">
                        <i class="bi bi-reply"></i>
                        {{ ('Вернуться назад') }}
                    </a>
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
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group mb-3">
                    <label for="permissions" class="col-md-4 col-form-label text-sm-end">
                        {{ ('Разрешения') }}
                    </label>
                    <div class="col-md-6">
                        <select id="permissions" class="form-select @error('permissions') is-invalid @enderror"
                                name="permissions[]" size="6" aria-describedby="permissionsHelp" multiple>
                            <option selected disabled>{{ ('Назначьте разрешения для новой роли...') }}</option>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-text" id="permissionsHelp">
                            {{ ('Вы можете назначить одновременно несколько разрешений для одной роли.') }}
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="bi bi-shield-plus"></i>
                        <span class="ml-1">{{ ('Создать роль') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
