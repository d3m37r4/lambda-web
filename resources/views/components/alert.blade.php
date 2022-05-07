@if (session('message'))
    <div class="d-flex alert alert-{{ session('status') }} alert-dismissible align-items-center fade show" id="alert">
        <i class="far fa-check-circle fa-2x me-1"></i>
        {{ session('message') }}
        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{--    <div class="d-flex alert alert-success alert-dismissible align-items-center fade show mt-3" id="alert">--}}
{{--        <i class="far fa-check-circle fa-2x me-1"></i>--}}
{{--        Message--}}
{{--        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
