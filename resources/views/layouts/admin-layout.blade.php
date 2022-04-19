@extends('layouts.main-layout')

@section('title', 'Панель управления')

@section('content')
{{--    @include('admin.components.breadcrubms')--}}
    <div class="row justify-content-center pt-3">
        <div class="col-md-3 mb-3">
            @include('admin.components.sidebar')
        </div>
        <div class="col-md-9 mb-3">
            @yield('admin.content')
        </div>
    </div>
@endsection

@push('secondary-scripts')
    <script src="{{ asset('js/lambda.confirm-delete.js') }}"></script>
@endpush
