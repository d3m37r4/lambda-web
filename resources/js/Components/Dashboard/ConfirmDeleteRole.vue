<template>
    <BaseModal v-model="local">
        <template #modal-title>
            {{ 'Подтверждение действия' }}
        </template>
        <template #modal-text>
            {{ ('Вы действительно хотите удалить эту роль?') }}
        </template>
        <template #modal-actions>
            <button @click="deleteRole(role)" class="btn btn-error">
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
        role: Number,
        modelValue: Boolean,
    },
    emits: ['update:modelValue'],
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
        deleteRole(role) {
            this.$inertia.delete(route('dashboard.roles.destroy', role), {
                onSuccess: () => {
                    this.local = false;
                },
                preserveState: true,
                preserveScroll: true,
            });
        }
    }
};
</script>
