<script setup>
import { computed } from 'vue';
import { trans } from 'laravel-vue-i18n';

const props = defineProps({
    role: {
        type: String,
        required: true,
    },
});

const roleName = computed(() => {
    return trans(`role.name.${props.role.toLowerCase()}`, 'role.name.unknown');
});
</script>

<template>
    <div class="badge badge-secondary rounded">
        {{ roleName }}
    </div>
</template>
