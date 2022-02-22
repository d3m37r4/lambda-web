@extends('layouts.admin-layout')

@section('title', 'Управление серверами')

@section('admin.content')
    @include('admin.modals.confirm-delete')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-server"></i>
                        {{ ('Управление серверами') }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('admin.components.link-add', ['route' => 'admin.servers.create', 'title' => 'Добавить'])
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
                            <th class="col-4">{{ ('Сервер') }}</th>
                            <th class="col-2">{{ ('Карта') }}</th>
                            <th class="col-1 text-center">{{ ('Онлайн') }}</th>
                            <th class="col-1 text-center">{{ ('Статус') }}</th>
                            <th style="min-width: 140px;">{{ ('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servers as $server)
                        <tr>
                            <td>
                                {{ $server->id }}
                            </td>
                            <td class="py-0">
                                <div class="d-inline-flex flex-column">
                                    <div class="border-bottom">
                                        <a class="link-primary"
                                           data-mdb-toggle="tooltip"
                                           title="{{ ('Показать дополнительную информацию о сервере') }}"
                                           href="{{ route('admin.servers.show', $server) }}">
                                            {{ $server->name }}
                                        </a>
                                    </div>
                                    <div>
                                        <span class="text-muted">
                                            {{ $server->full_address }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $server->map_name }}
                            </td>
                            <td class="text-center">
                                {{ "$server->num_players/$server->max_players" }}
                            </td>
                            <td class="text-center">
                                <span class="btn {{ $server->active ? 'btn-success' : 'btn-danger' }}
                                    btn-floating btn-sm pe-none">
                                    <i class="fas fa-power-off"></i>
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-info btn-floating btn-sm"
                                   data-mdb-toggle="tooltip"
                                   title="{{ ('Показать дополнительную информацию о сервере') }}"
                                   href="{{ route('admin.servers.show', $server) }}">
                                    <i class="fas fa-info"></i>
                                </a>
                                <a class="btn btn-primary btn-floating btn-sm"
                                   data-mdb-toggle="tooltip"
                                   title="{{ ('Редактировать сервер') }}"
                                   href="{{ route('admin.servers.edit', $server) }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <span class="d-inline-block" tabindex="0"
                                      data-mdb-toggle="tooltip" title="{{ ('Удалить сервер') }}">
                                    <button class="btn btn-danger btn-floating btn-sm"
                                            type="button"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#confirmDelete"
                                            data-route="{{ route('admin.servers.destroy', $server) }}"
                                            data-servername="{{ $server->name }}">
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
        {{ $servers->links() }}
    </div>
@endsection

@push('secondary-scripts')
    <script>
        let modalDeleteServer = document.getElementById('confirmDelete');
        modalDeleteServer.addEventListener('show.bs.modal', function (event) {
            let confirmMsg = "{{ ('Вы действительно хотите удалить сервер @servername?') }}";
            let btn = event.relatedTarget;
            this.querySelector('.route').action = btn.getAttribute('data-route');

            let name = btn.getAttribute('data-servername');
            confirmMsg = confirmMsg.replace('@servername', name);

            this.querySelector('.modal-title').textContent = "{{ ('Удаление сервера') }}";
            this.querySelector('.modal-msg').textContent = confirmMsg;
            this.querySelector('.modal-btn-title').textContent = "{{ ('Удалить сервер') }}";
        });
    </script>
@endpush

