@extends('layouts.admin-layout')

@section('title', 'Новая роль')

@section('admin.content')
    <div class="card mb-3">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        <i class="bi bi-person-plus-fill"></i>
                        {{ 'Новая роль' }}
                    </h5>
                </div>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.index') }}">
                        <i class="bi bi-reply"></i>
                        {{ ('Вернуться назад') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf

            </form>
        </div>
    </div>
@endsection
