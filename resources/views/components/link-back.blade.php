<a class="btn btn-primary"
   href="@if (session('redirect_url')) {{ session('redirect_url') }} @else {{ route($redirect_route) }} @endif">
    <i class="fas fa-reply"></i>
    {{ ('Назад') }}
</a>
