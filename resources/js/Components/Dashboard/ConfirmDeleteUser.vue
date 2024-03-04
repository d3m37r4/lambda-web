<script setup>
import BaseModal from '@/Components/BaseModal.vue';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    id: Number,
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
const deleteUser = (index) => {
    Inertia.delete(route('dashboard.users.destroy', index), {preserveScroll: true});
}
</script>

<template>
    <BaseModal v-model="local">
        <template #modal-title>
            {{ 'Удаление пользователя' }}
        </template>
        <template #modal-text>
            {{ ('Вы действительно хотите удалить этого пользователя?') }}
        </template>
        <template #modal-actions>
            <button @click="deleteUser(id)" class="btn btn-error">
                {{ ('Удалить') }}
            </button>
            <button @click="modelValue=false" class="btn">
                {{ ('Отмена') }}
            </button>
        </template>
    </BaseModal>
</template>
