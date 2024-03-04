<script setup>
defineProps({
    modelValue: Boolean,
});
defineEmits(['update:modelValue']);
</script>

<template>
    <div class="modal" :class="{ 'modal-open': modelValue }">
        <div class="modal-box">
            <h3 class="font-bold text-lg">
                <slot name="modal-title" />
            </h3>
            <p class="py-4">
                <slot name="modal-text" />
            </p>
            <div class="modal-action">
                <slot name="modal-actions" />
            </div>
        </div>
    </div>
</template>
