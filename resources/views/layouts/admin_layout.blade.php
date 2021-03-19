@extends('layouts.main_layout')

@section('content')
    {{--    @include('admin.components.breadcrubms')--}}
    <div class="justify-content-center">
        @yield('admin.content')
    </div>
@endsection
