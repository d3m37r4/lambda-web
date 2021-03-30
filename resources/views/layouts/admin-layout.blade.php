@extends('layouts.main-layout')

@section('title')
    {{ 'Панель управления' }}
@endsection

@section('content')
{{--    @include('admin.components.breadcrubms')--}}

    <div class="row justify-content-center">
        <div class="col-md-3 mb-3">
            @include('admin.components.sidebar')
        </div>
        <div class="col-md-9 mb-3">
            @yield('admin.content')
        </div>
    </div>
@endsection
