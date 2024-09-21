<script setup>
import { onMounted } from "vue";

const props = defineProps({
    status: String,
    message: String,
    duration: {
        type: Number,
        default: 2000,
    },
});

const emit = defineEmits(['remove']);

onMounted(() => {
    setTimeout(() => emit('remove'), props.duration);
});
</script>

<template>
    <div class="toast-item">
        <div class="inline-flex items-center justify-center w-8 h-8 flex-shrink-0 rounded-lg"
             :class="{'bg-green-800 text-green-200': props.status === 'success',
            'bg-red-800 text-red-200': props.status === 'deleted',
            'bg-orange-800 text-orange-200': props.status === 'error'}">
            <svg v-if="status === 'success'" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <svg v-else-if="status === 'deleted'" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <svg v-else-if="status === 'error'" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
        </div>
        <p class="text-sm text-balance -mt-1">
            {{ props.message }}
        </p>
        <button type="button" @click="emit('remove')" class="btn btn-xs btn-neutral h-8 w-8">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
        </button>
    </div>
</template>
