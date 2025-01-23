<script setup>
import Button from "@/Components/Buttons/Button.vue";

defineProps({
    locale: String,
    isActive: Boolean,
});

const emit = defineEmits(['click']);
</script>

<template>
    <Button
        @click="emit('click')"
        class="btn dropdown-content--btn"
        :class="{ 'btn-active': isActive }">
        <span class="badge badge-sm badge-outline font-mono uppercase opacity-50">
            {{ $t(locale) }}
        </span>
        <span class="font-normal">
            {{ $t(`locale.${locale}`) }}
        </span>
    </Button>
</template>
