@extends('layouts.admin-layout')

@section('admin.content')
    <div class="card">
        <div class="card-header">{{ ('Редактирование пользователя ') .$user->name }}</div>
        <div class="card-body">
            <form id="edit-user-form" action="{{ route('admin.users.edit', $user->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="name">{{ ('Имя пользователя') }}</label>
                    </div>
                    <div class="col-sm">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', isset($user) ? $user->name : '') }}" required autocomplete="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="email">{{ ('Email') }}</label>
                    </div>
                    <div class="col-sm">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"       value="{{ old('email', isset($user) ? $user->email : '') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="password">{{ ('Пароль') }}</label>
                    </div>
                    <div class="col-sm">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="role">{{ ('Роль пользователя') }}</label>
                    </div>
                    <div class="col-sm">
                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                            @foreach($roles as $roleId => $roleName)
                                <option value="{{ $roleId }}" {{ (in_array($roleId, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'id')->contains($roleId)) ? 'selected' : '' }}>
                                    {{ $roleName }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="permissions">{{ ('Разрешения') }}</label>
                    </div>
                    <div class="col-sm">
                        <select id="permissions" name="permission[]" class="form-control" multiple>
                        <option selected disabled>{{ ('Выберите разрешения ...') }}</option>
                            @foreach($permissions as $permissionId => $permissionName)
                                <option value="{{ $permissionId }}" {{ (in_array($permissionId, old('permissions', [])) || isset($role) && $role->permissions->contains($permissionId)) ? 'selected' : '' }}>
                                    {{ $permissionName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <a class="btn btn-success btn-sm" href="{{ route('admin.users.edit', $user->id) }}"
                  onclick="event.preventDefault(); document.getElementById('edit-user-form').submit();">
                <i class="fas fa-save"></i>
                <span class="ml-1">{{ ('Сохранить изменения') }}</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-undo-alt"></i>
                <span class="ml-1">{{ ('Отмена') }}</span>
            </a>
        </div>
    </div>
@endsection
