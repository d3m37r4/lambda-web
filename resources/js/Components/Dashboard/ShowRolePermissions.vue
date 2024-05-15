<script setup>
import BaseModal from '@/Components/BaseModal.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    roleName: String,
    permissions: Object,
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
</script>

<template>
    <BaseModal v-model="local">
        <template #modal-title>
            {{ 'Доступные разрешения роли' }} {{ roleName }}
        </template>
        <template #modal-text>
            <template v-for="permission in permissions">
                <span class="badge badge-primary rounded me-1">{{ permission.name }}</span>
            </template>
        </template>
        <template #modal-actions>
            <button @click="local=false" class="btn">
                {{ ('Отмена') }}
            </button>
        </template>
    </BaseModal>
</template>
