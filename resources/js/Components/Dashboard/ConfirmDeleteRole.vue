<script setup>
import BaseModal from '@/Components/BaseModal.vue';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    role: Number,
    modelValue: Boolean,
});
const emits = defineEmits(['update:modelValue']);
const local = ref(props.modelValue);

watch(local, (newValue) => {
    emits('update:modelValue', newValue);
});
watch(() => props.modelValue, (newValue) => {
    local.value = newValue;
});

function deleteRole(role) {
    Inertia.delete(route('dashboard.roles.destroy', role));
}
</script>

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
