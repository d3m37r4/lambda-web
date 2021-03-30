@if (session('status'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert" id="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
