@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        @include('admin.layouts.sidebar')
        <div class="col-8">
			@yield('admin_content')
        </div>
    </div>
@endsection