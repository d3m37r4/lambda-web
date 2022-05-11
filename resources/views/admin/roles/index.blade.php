@extends('layouts.admin-layout')

@section('title', __('roles.management'))

@section('admin.content')
    @include('admin.modals.confirm-delete')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user-shield"></i>
                        {{ __('roles.management') }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('admin.components.link-add', ['route' => 'admin.roles.create', 'title' => 'Добавить'])
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="d-flex m-3">
                @include('admin.components.search-form')
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="col-2">{{ ('ID') }}</th>
                            <th class="col-3">{{ __('roles.role') }}</th>
                            <th class="col-3">{{ ('Время создания') }}</th>
                            <th class="col-3">{{ ('Последнее обновление') }}</th>
                            <th style="min-width: 140px;">{{ ('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>
                                {{ $role->id }}
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ __("roles.list.$role->name") }}</span>
                            </td>
                            <td>
                                {{ $role->created_at }}
                            </td>
                            <td>
                                {{ $role->updated_at }}
                            </td>
                            <td>
                                <a class="btn btn-info btn-floating btn-sm"
                                   data-mdb-toggle="tooltip"
                                   title="{{ ('Показать разрешения доступные для данной роли') }}"
                                   href="#">
                                    <i class="fas fa-info"></i>
                                </a>
                                <a class="btn btn-primary btn-floating btn-sm"
                                   data-mdb-toggle="tooltip"
                                   title="{{ ('Редактировать роль') }}"
                                   href="{{ route('admin.roles.edit', $role) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <span class="d-inline-block"
                                      tabindex="0"
                                      data-mdb-toggle="tooltip"
                                      title="{{ __('roles.delete') }}">
                                    <button class="btn btn-danger btn-floating btn-sm"
                                            type="button"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#confirmDelete"
                                            data-modal-title="{{ __('roles.delete') }}"
                                            data-modal-message="{{ __('roles.confirm_delete', ['role' => __("roles.list.$role->name")]) }}"
                                            data-modal-route="{{ route('admin.roles.destroy', $role) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $roles->links() }}
@endsection
