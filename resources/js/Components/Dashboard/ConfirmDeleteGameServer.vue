<template>
    <BaseModal v-model="local">
        <template #modal-title>
            {{ 'Подтверждение действия' }}
        </template>
        <template #modal-text>
            {{ ('Вы действительно хотите удалить этот сервер?') }}
        </template>
        <template #modal-actions>
            <button @click="deleteGameServer(game_server)" class="btn btn-error">
                {{ ('Удалить') }}
            </button>
            <button @click="local=false" class="btn">
                {{ ('Отмена') }}
            </button>
        </template>
    </BaseModal>
</template>

<script>
import BaseModal from '@/Components/BaseModal.vue';
import { ref, watch } from 'vue';

export default {
    components: {
        BaseModal,
    },
    props: {
        game_server: Number,
        modelValue: Boolean,
        currentPage: Number,
    },
    emits: ['update:modelValue', 'deleteSelectedItems'],
    setup(props, ctx) {
        const local = ref(props.modelValue);

        watch(local, (newValue) => {
            ctx.emit('update:modelValue', newValue);
        });

        watch(() => props.modelValue, (newValue) => {
            local.value = newValue;
        });

        return { local };
    },
    methods: {
        deleteGameServer(game_server) {
            this.$inertia.delete(route('dashboard.game-servers.destroy', game_server), {
                data: {
                    current_page: this.currentPage,
                },
                onSuccess: () => {
                    this.local = false;
                    this.$emit('deleteSelectedItems');
                },
                preserveState: true,
                preserveScroll: true,
            });
        }
    }
};
</script>
