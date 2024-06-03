<template>
    <Transition
        tag="div"
        enter-from-class="opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="opacity-0"
    >
        <div v-if="selected.length > 0" class="flex items-center justify-between">
            <div>
                {{ 'Выбрано записей:' }} {{ selected.length }}
            </div>
            <div>
                <button @click="deleteSelected()" class="btn btn-sm btn-error normal-case">
                    <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                    {{ 'Удалить отмеченные' }}
                </button>
            </div>
        </div>
    </Transition>
</template>

<script>
export default {
    props: {
        selected: Array,
        routeAction: String,
        currentPage: Number,
    },
    methods: {
        deleteSelected() {
            this.$inertia.delete(this.routeAction, {
                data: {
                    ids: this.selected,
                    current_page: this.currentPage,
                },
                onSuccess: () => {
                    this.$emit('deleteSelectedItems');
                },
                preserveState: true,
                preserveScroll: true,
            });
        }
    }
}
</script>
