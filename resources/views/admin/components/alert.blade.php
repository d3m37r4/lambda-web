@if (session('message'))
    <div class="d-flex alert alert-{{ session('status') }} alert-dismissible align-items-center
                fade show shadow-2 border border-{{ session('status') }}" id="alert">
        <i class="far fa-check-circle fa-2x me-1"></i>
        {{ session('message') }}
        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
