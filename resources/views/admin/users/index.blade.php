@extends('layouts.admin-layout')

@section('title', 'Управление пользователями')

@section('admin.content')
    @include('admin.modals.confirm-delete')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-users-cog"></i>
                        {{ ('Управление пользователями') }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('admin.components.link-add', ['route' => 'admin.users.create', 'title' => 'Добавить'])
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
                            <th class="col-3">{{ ('Пользователь') }}</th>
                            <th class="col-3">{{ ('Эл. почта') }}</th>
                            <th class="col-3">{{ ('Роль') }}</th>
                            <th style="min-width: 140px;">{{ ('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    <a class="link-primary"
                                       data-mdb-toggle="tooltip"
                                       title="{{ ('Показать профиль пользователя') }}"
                                       href="{{ route('admin.users.show', $user->id) }}">
                                        {{ $user->name }}
                                    </a>

                                </td>
                                <td>
                                    <a class="link-primary"
                                       data-mdb-toggle="tooltip"
                                       title="Email {{ $user->email }}"
                                       href="mailto:{{ $user->email }}">
                                        {{ $user->email }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $user->getRoleNames()->first() }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-floating btn-sm"
                                       data-mdb-toggle="tooltip"
                                       title="{{ ('Показать профиль пользователя') }}"
                                       href="{{ route('admin.users.show', $user->id) }}">
                                        <i class="fas fa-info"></i>
                                    </a>
                                    <a class="btn btn-primary btn-floating btn-sm"
                                       data-mdb-toggle="tooltip"
                                       title="{{ ('Редактировать пользователя') }}"
                                       href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <span class="d-inline-block" tabindex="0"
                                        data-mdb-toggle="tooltip" title="{{ ('Удалить пользователя') }}">
                                        <button class="btn btn-danger btn-floating btn-sm"
                                                type="button"
                                                data-mdb-toggle="modal"
                                                data-mdb-target="#confirmDelete"
                                                data-route="{{ route('admin.users.destroy', $user->id) }}"
                                                data-username="{{ $user->name }}">
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
    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection

@push('secondary-scripts')
    <script>
        let modalDeleteUser = document.getElementById('confirmDelete');
        modalDeleteUser.addEventListener('show.mdb.modal', function (event) {
            let confirmMsg = "{{ ('Вы действительно хотите удалить пользователя @username?') }}";
            let btn = event.relatedTarget;
            this.querySelector('.route').action = btn.getAttribute('data-route');

            let name = btn.getAttribute('data-username');
            confirmMsg = confirmMsg.replace('@username', name);

            this.querySelector('.modal-title').textContent = "{{ ('Подтверждение действия') }}";
            this.querySelector('.modal-msg').textContent = confirmMsg;
            this.querySelector('.modal-btn-title').textContent = "{{ ('Удалить') }}";
        });
    </script>
@endpush
