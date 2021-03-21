@extends('layouts.main-layout')

@section('title')
    @hasSection('admin.title')
        @yield('admin.title') |
    @endif
    {{ 'Панель управления' }}
@endsection

@section('content')
    {{--    @include('admin.components.breadcrubms')--}}
    <div class="justify-content-center">
        @yield('admin.content')
    </div>
@endsection
