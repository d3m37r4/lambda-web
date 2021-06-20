<div class="list-group shadow-2">
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.index') ? 'active' : '' }}"
       href="{{ route('admin.index') }}">
        <i class="fas fa-cogs"></i>
        {{ ('Панель управления') }}
    </a>
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.users.*') ? 'active' : '' }}"
       href="{{ route('admin.users.index') }}">
        <i class="fas fa-users-cog"></i>
        {{ ('Управление пользователями') }}
    </a>
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.roles.*') ? 'active' : '' }}"
       href="{{ route('admin.roles.index') }}">
        <i class="fas fa-user-shield"></i>
        {{ ('Управление ролями') }}
    </a>
    <a class="list-group-item list-group-item-action {{ Request::routeIs('admin.servers.*') ? 'active' : '' }}"
       href="{{ route('admin.servers.index') }}">
        <i class="fas fa-server"></i>
        {{ ('Управление серверами') }}
    </a>
</div>
