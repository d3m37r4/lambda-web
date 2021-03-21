@extends('layouts.admin-layout')

@section('admin.title')
    {{ 'Управление пользователями сайта' }}
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
<div class="card">
    <div class="card-header">
        <div class="d-flex">
            <div class="w-100">
                {{ ('Управление пользователями сайта') }}
            </div>
            <div class="flex-shrink-1">
                <a class="btn btn-success btn-sm" href="#" title="Создать нового пользователя">
                    <i class="bi bi-person-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table">
                <thead>
                    <tr>
{{--                        <th class="p-2">{{ ('#') }}</th>--}}
                        <th>{{ ('ID') }}</th>
                        <th>{{ ('Имя пользователя') }}</th>
                        <th>{{ ('E-mail') }}</th>
                        <th>{{ ('Группа') }}</th>
                        <th>{{ ('Действие') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        <tr>
{{--                            <td>{{ $loop->iteration }}</td>--}}
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a class="link-primary" title="email {{ $user->email }}" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $user->getRoleNames()->first() }}
                                </span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('{{ ('Вы действительно хотите удалить пользователя ' .$user->name. '?') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $users->links() }}
    </div>
</div>

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--    $(".alert").delay(2000).slideUp(500, function() {--}}
{{--        $(this).alert('close');--}}
{{--    });--}}
{{--    </script>--}}
@endsection
