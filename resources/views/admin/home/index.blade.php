@extends('layouts.admin-layout')

@section('admin.content')
        <div class="card">
            <div class="card-header">
                {{ ('Панель управления') }}
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ ('Зарегистрировано пользователей: ') .$usersCount }}

                <div class="table-responsive">
                    <table class="table table-bordered">

                        @foreach($envs as $env)
                            <tr>
                                <td width="120px">{{ $env['name'] }}</td>
                                <td>{{ $env['value'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
@endsection
