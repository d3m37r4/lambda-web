<div class="list-group shadow-2">
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.index') ? 'active' : '' }} ripple"
       href="{{ route('admin.index') }}" data-mdb-ripple-color="light">
        <i class="fas fa-cogs"></i>
        {{ ('Панель управления') }}
    </a>
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.users.*') ? 'active' : '' }} ripple"
       href="{{ route('admin.users.index') }}" data-mdb-ripple-color="light">
        <i class="fas fa-users-cog"></i>
        {{ ('Управление пользователями') }}
    </a>
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.roles.*') ? 'active' : '' }} ripple"
       href="{{ route('admin.roles.index') }}" data-mdb-ripple-color="light">
        <i class="fas fa-user-shield"></i>
        {{ ('Управление ролями') }}
    </a>
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.servers.*') ? 'active' : '' }} ripple"
       href="{{ route('admin.servers.index') }}" data-mdb-ripple-color="light">
        <i class="fas fa-server"></i>
        {{ ('Управление серверами') }}
    </a>
</div>
