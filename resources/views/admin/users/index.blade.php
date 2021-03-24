@extends('layouts.admin-layout')

@section('title')
    {{ 'Управление пользователями' }}
@endsection

@section('admin.content')
    {{--    @if (session('status'))--}}
    {{--        <div class="alert alert-info alert-dismissible fade show" role="alert">--}}
    {{--            {{ session('status') }}--}}
    {{--            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
    {{--                <span aria-hidden="true">&times;</span>--}}
    {{--            </button>--}}
    {{--        </div>--}}
    {{--    @endif--}}
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
                    <a class="btn btn-success btn-sm" title="{{ ('Создать нового пользователя') }}"
                        href="{{ route('admin.users.create') }}">
                        <i class="bi bi-person-plus-fill"></i>
                        {{ ('Новый пользователь') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
{{--            <div class="d-flex justify-content-between pb-3">--}}
{{--                <div>--}}
{{--                    <h5 class="card-title">--}}
{{--                        <i class="bi bi-people-fill"></i>--}}
{{--                        {{ ('Пользователи') }}--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="d-grid gap-2 d-md-block">--}}
{{--                    <a class="btn btn-success btn-sm" href="#" title="{{ ('Создать нового пользователя') }}">--}}
{{--                        <i class="bi bi-person-plus-fill"></i>--}}
{{--                        {{ ('Новый пользователь') }}--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="border-bottom"></div>--}}
{{--            <nav class="navbar">--}}
{{--                <div class="container-fluid">--}}
{{--                    <form class="d-flex">--}}
{{--                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--                        <button class="btn btn-outline-success" type="submit">Search</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--            @include('components.search-users-form')--}}

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
                        @foreach($users as $key => $user)
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
                                        <i class="bi bi-view-stacked"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm"
                                       href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('{{ ('Вы действительно хотите удалить пользователя ' .$user->name. '?') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $users->links() }}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--    $(".alert").delay(2000).slideUp(500, function() {--}}
{{--        $(this).alert('close');--}}
{{--    });--}}
{{--    </script>--}}
@endsection
