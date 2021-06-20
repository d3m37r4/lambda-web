@if (session('message'))
    <div class="alert alert-{{ session('status') }} alert-dismissible fade show" id="alert" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
