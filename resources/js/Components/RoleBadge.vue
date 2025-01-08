<script setup>
import { getRoleName } from "@/Utils/role.js";

const props = defineProps({
    role: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="badge badge-secondary rounded">
        {{ getRoleName(role) }}
    </div>
</template>
