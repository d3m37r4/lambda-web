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
                <input type="hidden" class="data-modal-msg" value="{{ ('Вы действительно хотите удалить пользователя @username?') }}">
                <p class="modal-msg"></p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                   <i class="bi bi-x-circle"></i>
                   {{ ('Отмена') }}
               </button>
                <form method="POST" class="route">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash-fill"></i>
                        {{ ('Удалить пользователя') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

