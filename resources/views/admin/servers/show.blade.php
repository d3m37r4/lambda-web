@extends('layouts.admin-layout')

@section('title', "Сервер $server->name")

@section('admin.content')
    <div class="card shadow-2 border">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between">
                <div class="me-auto align-self-center">
                    <h5 class="card-title m-0">
                        <i class="fas fa-user"></i>
                        {{ ("Сервер: $server->name") }}
                    </h5>
                </div>
                <div class="d-grid">
                    @include('admin.components.link-back', ['link' => $redirect, 'title' => 'Назад'])
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
                        <text x="40%" y="50%" fill="#dee2e6" >
                            Map name
                        </text>
                    </svg>
                </div>
                <div class="col-md-5">
                    <div class="pb-3">
                        <table class="server-info-table">
                            <tbody>
                            <tr>
                                <td>Адрес сервера</td>
                                <td>127.0.0.1:27015</td>
                            </tr>
                            <tr>
                                <td>Игроков онлайн</td>
                                <td id="online">11/32 (34%)</td>
                            </tr>
                            <tr>
                                <td>Текущая карта</td>
                                <td id="map">de_dust2_2x2</td>
                            </tr>
                            <tr>
                                <td>Обновлен</td>
                                <td id="time">4 минуты 3 секунды назад</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <ul class="nav nav-tabs nav-justified mb-3" id="ex1">
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
                            <a class="nav-link" href="#ex1-tabs-3" id="ex1-tab-3" data-mdb-toggle="tab"
                               aria-controls="ex1-tabs-3" aria-selected="false">
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
                        <div class="tab-pane fade" id="ex1-tabs-3" aria-labelledby="ex1-tab-3">
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
