<div class="list-group">
    <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.index') ? 'active' : '' }}"
       href="{{ route('admin.index') }}">
        <i class="bi bi-tools"></i>
        {{ ('Панель управления') }}
    </a>
    <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
       href="{{ route('admin.users.index') }}">
        <i class="bi bi-people-fill"></i>
        {{ ('Управление пользователями') }}
    </a>
    <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}"
       href="{{ route('admin.roles.index') }}">
        <i class="bi bi-shield-fill"></i>
        {{ ('Управление ролями') }}
    </a>
    <a class="list-group-item list-group-item-action"
       href="#">
        <i class="bi bi-server"></i>
        {{ ('Управление серверами') }}
    </a>
{{--        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">--}}
{{--            A disabled link item--}}
{{--        </a>--}}
</div>
