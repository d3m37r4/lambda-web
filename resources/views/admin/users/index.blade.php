@extends('layouts.admin-layout')

@section('title', 'Управление пользователями')

@section('admin.content')
    @include('admin.modals.confirm-delete')
    @include('admin.components.alert')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-people-fill"></i>
                        {{ ('Управление пользователями') }}
                    </h5>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <a class="btn btn-success btn-sm"
                        href="{{ route('admin.users.create') }}">
                        <i class="bi bi-person-plus-fill"></i>
                        {{ ('Новый пользователь') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-2">{{ ('#') }}</th>
                            <th class="col-3">{{ ('Имя') }}</th>
                            <th class="col-3">{{ ('E-mail') }}</th>
                            <th class="col-2">{{ ('Роль') }}</th>
                            <th class="col-2">{{ ('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    <a class="link-primary" title="email {{ $user->email }}"
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
                                    <a class="btn btn-primary btn-sm"
                                       href="#">
                                        <i class="bi bi-info-square"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm"
                                       href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#confirmDelete"
                                            data-route="{{ route('admin.users.destroy', $user->id) }}"
                                            data-username="{{ $user->name }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $users->links() }}
@endsection

@push('secondary-scripts')
    <script>
        let modalDeleteUser = document.getElementById('confirmDelete');
        modalDeleteUser.addEventListener('show.bs.modal', function (event) {
            let confirmMsg = "{{ ('Вы действительно хотите удалить пользователя @username?') }}";
            let btn = event.relatedTarget;
            this.querySelector('.route').action = btn.getAttribute('data-route');

            let name = btn.getAttribute('data-username');
            confirmMsg = confirmMsg.replace('@username', name);

            this.querySelector('.modal-title').textContent = "{{ ('Удаление пользователя') }}";
            this.querySelector('.modal-msg').textContent = confirmMsg;
            this.querySelector('.modal-btn-title').textContent = "{{ ('Удалить пользователя') }}";
        });
    </script>
@endpush
