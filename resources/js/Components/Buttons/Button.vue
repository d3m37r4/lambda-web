<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    className: {
        type: String,
        default: 'btn normal-case'
    },
    href: String,
});

</script>

<template>
    <Link v-if="href" :href="href" :class="className">
        <slot />
    </Link>
    <button v-else :class="className">
        <slot />
    </button>
</template>
