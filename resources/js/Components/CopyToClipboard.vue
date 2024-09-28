<script setup>
import toast from "@/Store/toast";

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
});

const copyToClipboard = async () => {
    if (!props.text) {
        return;
    }

    try {
        await navigator.clipboard.writeText(props.text);
        toast.add({
            status: 'success',
            message: 'Токен скопирован в буфер обмена.',
        });
    } catch (err) {
        console.error('Failed to copy the token: ', err);
        toast.add({
            status: 'error',
            message: 'Не удалось скопировать токен.',
        });
    }
}
</script>

<template>
    <button type="button" class="btn join-item btn-neutral" @click="copyToClipboard">
        <slot />
    </button>
</template>
