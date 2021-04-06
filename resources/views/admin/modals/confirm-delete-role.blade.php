<div class="modal fade" id="confirmDeleteRole" role="dialog"
     aria-labelledby="confirmDeleteRoleLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteRoleLabel">
                    {{ ('Удаление пользователя') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="data-msg-confirm-delete-role"
                       value="{{ ('Вы действительно хотите удалить роль @rolename?') }}">
                <p class="msg-confirm-delete-role"></p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                   <i class="bi bi-x-circle"></i>
                   {{ ('Отмена') }}
               </button>
               <form method="POST" class="route-delete-role">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash-fill"></i>
                        {{ ('Удалить роль') }}
                    </button>
               </form>
            </div>
        </div>
    </div>
</div>

