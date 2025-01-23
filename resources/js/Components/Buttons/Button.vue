<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    className: {
        type: String,
        default: 'btn normal-case'
    },
    link: String,
});

</script>

<template>
    <Link v-if="link" :href="link" :class="className">
        <slot />
    </Link>
    <button v-else :class="className">
        <slot />
    </button>
</template>
