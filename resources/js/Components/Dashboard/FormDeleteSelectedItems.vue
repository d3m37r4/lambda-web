<template>
    <transition name="fade">
        <div v-if="selected.length > 0" class="flex items-center justify-between">
            <div>
                <span>
                    {{ 'Выбрано записей:' }} {{ selected.length }}
                </span>
            </div>
            <div>
                <button @click="deleteSelected()" class="btn btn-sm btn-error normal-case">
                    <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                    {{ 'Удалить отмеченные' }}
                </button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        selected: Array,
        routeAction: String,
    },
    methods: {
        deleteSelected() {
            this.$inertia.delete(this.routeAction, {
                data: {
                    ids: this.selected
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
