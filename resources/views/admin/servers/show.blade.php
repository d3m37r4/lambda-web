@extends('layouts.admin-layout')

@section('title', "$server->name")

@section('admin.content')
    @include('admin.modals.confirm-delete')
    @include('admin.components.alert')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-hdd"></i>
                        {{ ("$server->name") }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('admin.components.link-back', ['redirect_route' => 'admin.servers.index'])
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <svg class="img-fluid shadow-2-strong rounded"
                         xmlns="http://www.w3.org/2000/svg"
                         width="400" height="300" focusable="false">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="40%" y="50%" fill="#dee2e6">
                            Map name
                        </text>
                    </svg>
                </div>
                <div class="col-md-8">
                    <div class="d-sm-flex justify-content-between">
                        <div class="me-auto align-self-center">
                            {{ ('Адрес сервера') }}
                        </div>
                        <div class="d-grid">
                            <a class="link-primary"
                               data-mdb-toggle="tooltip"
                               title="{{ ('Подключиться к серверу') }}"
                               href="steam://connect/{{ $server->full_address }}">
                                {{ $server->full_address }}
                            </a>
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-between">
                        <div class="me-auto align-self-center">
                            {{ ('Игроков онлайн') }}
                        </div>
                        <div class="d-grid">
                            {{ "$server->num_players/$server->max_players" }}
                            {{ "($server->percent_players%)" }}
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-between">
                        <div class="me-auto align-self-center">
                            {{ ('Текущая карта') }}
                        </div>
                        <div class="d-grid">
                            {{ $server->map_name }}
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-between">
                        <div class="me-auto align-self-center">
                            {{ ('Сервер добавлен') }}
                        </div>
                        <div class="d-grid">
                            {{ $server->created_at }}
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-between">
                        <div class="me-auto align-self-center">
                            {{ ('Последнее обновление') }}
                        </div>
                        <div class="d-grid">
                            {{ $server->updated_at }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <ul class="nav nav-tabs nav-fill mb-3" id="ex1">
                        <li class="nav-item">
                            <a class="nav-link active" href="#ex1-tabs-1" id="ex1-tab-1" data-mdb-toggle="tab"
                               aria-controls="ex1-tabs-1" aria-selected="true">
                                {{ ('Игроки онлайн') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ex1-tabs-2" id="ex1-tab-2" data-mdb-toggle="tab"
                               aria-controls="ex1-tabs-2" aria-selected="false">
                                {{ ('Группы привилегий') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reasons" id="ex1-tab-3" data-mdb-toggle="tab"
                               aria-controls="reasons" aria-selected="false">
                                {{ ('Причины наказаний') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ex1-tabs-4" id="ex1-tab-4" data-mdb-toggle="tab"
                               aria-controls="ex1-tabs-4" aria-selected="false">
                                {{ ('Привилегии') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ex1-tabs-5" id="ex1-tab-5" data-mdb-toggle="tab"
                               aria-controls="ex1-tabs-5" aria-selected="false">
                                {{ ('Доступы') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="ex1-content">
                        <div class="tab-pane fade show active" id="ex1-tabs-1" aria-labelledby="ex1-tab-1">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex1-tabs-2" aria-labelledby="ex1-tab-2">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reasons" aria-labelledby="reasons">
                            <div class="mb-3">
                                <a class="btn btn-success"
                                   href="{{ route('admin.servers.reasons.create', $server->id) }}">
                                    <i class="fas fa-plus"></i>
                                    {{ ('Добавить причину наказаний') }}
                                </a>
                            </div>
                            @if(!$server->reasons->isEmpty())
                                <div class="border table-responsive rounded">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th class="col-1">{{ ('#') }}</th>
                                                <th class="col-1">{{ ('ID') }}</th>
                                                <th class="col-4">{{ ('Название причины') }}</th>
                                                <th class="col-4">{{ ('Длительность наказания') }}</th>
                                                <th class="text-center" style="min-width: 30px;">{{ ('Действия') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($server->reasons as $reason)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $reason->id }}
                                                </td>
                                                <td>
                                                    {{ $reason->title }}
                                                </td>
                                                <td>
                                                    {{ $reason->time_for_humans }}
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-floating btn-sm"
                                                       data-mdb-toggle="tooltip"
                                                       title="{{ ('Редактировать причину') }}"
                                                       href="{{ route('admin.servers.reasons.edit', [
                                                           $server,
                                                           $reason
                                                       ]) }}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <span class="d-inline-block"
                                                          tabindex="0"
                                                          data-mdb-toggle="tooltip"
                                                          title="{{ ('Удалить причину') }}">
                                                        <button class="btn btn-danger btn-floating btn-sm"
                                                                type="button"
                                                                data-mdb-toggle="modal"
                                                                data-mdb-target="#confirmDelete"
                                                                data-route="{{ route('admin.servers.reasons.destroy', [
                                                                    $server,
                                                                    $reason
                                                                ]) }}"
                                                                data-reasonname="{{ $reason->title }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="d-flex alert alert-info align-items-center">
                                    <i class="fas fa-info-circle fa-2x me-1"></i>
                                    {{ ('Причины наказаний для этого сервера еще не заданы.') }}
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="ex1-tabs-4" aria-labelledby="ex1-tab-4">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex1-tabs-5" aria-labelledby="ex1-tab-5">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                            <th>col</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                        <tr>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                            <td>text</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('secondary-scripts')
    <script>
        let modalDeleteServer = document.getElementById('confirmDelete');
        modalDeleteServer.addEventListener('show.bs.modal', function (event) {
            let confirmMsg = "{{ ('Вы действительно хотите удалить причину @reasonname?') }}";
            let btn = event.relatedTarget;
            this.querySelector('.route').action = btn.getAttribute('data-route');

            let name = btn.getAttribute('data-reasonname');
            confirmMsg = confirmMsg.replace('@reasonname', name);

            this.querySelector('.modal-title').textContent = "{{ ('Удаление причины') }}";
            this.querySelector('.modal-msg').textContent = confirmMsg;
            this.querySelector('.modal-btn-title').textContent = "{{ ('Удалить причину') }}";
        });
    </script>
@endpush
