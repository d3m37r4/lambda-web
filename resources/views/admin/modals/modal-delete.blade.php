<div class="modal fade" id="confirmDelete" role="dialog"
     aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">
                    {{ ('Удаление пользователя') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    {{ ('Вы действительно хотите удалить пользователя ' .$user->name. '?') }}
                </p>
            </div>
            <div class="modal-footer">
{{--                {!! Form::button(trans('laravelusers::modals.delete_user_btn_cancel'), array('class' => 'btn btn-light pull-left', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}--}}
{{--                {!! Form::button(trans('laravelusers::modals.delete_user_btn_confirm'), array('class' => 'btn btn-danger pull-right btn-flat', 'type' => 'button', 'id' => 'confirm' )) !!}--}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-danger" onclick="confirm()">Удалить пользователя</button>
            </div>
        </div>
    </div>
</div>

