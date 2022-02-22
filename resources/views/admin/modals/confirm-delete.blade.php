<div class="modal fade" id="confirmDelete" role="dialog"
     aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel"></h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-msg"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                    {{ ('Отмена') }}
                </button>
                <form method="POST" class="route">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger modal-btn-title">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

