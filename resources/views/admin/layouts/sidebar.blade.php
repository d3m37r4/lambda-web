<div class="col-4">
    <div class="card">
        <div class="card-header">{{ ('Список разделов панели управления') }}</div>
        <div class="list-group list-group-flush">
            <a href="{{ route('admin.index') }}" class="list-group-item list-group-item-action">
                {{ ('Главная страница панели управления') }}
            </a>
            <a href="{{ route('admin.roles.index') }}" class="list-group-item list-group-item-action">
                {{ ('Управление ролями пользователей') }}
            </a>
            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                {{ __('admin.users.manage_title') }}
            </a>
            {{--<a href="/" class="list-group-item list-group-item-action">
                {{ ('Управление игровыми серверами') }}
            </a>--}}
            <!--<a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
            <a href="#" class="list-group-item list-group-item-action active">Cras justo odio</a>-->
        </div>
    </div>
</div>
