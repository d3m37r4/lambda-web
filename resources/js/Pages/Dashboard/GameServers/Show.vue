<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import BackButton from "@/Components/BackButton.vue";

defineOptions({
    layout: DashboardLayout
});

const props = defineProps({
    title: String,
    gameServer: Object,
});

</script>

<template>
    <div class="ml-4 space-y-4">
        <div class="flex items-center space-x-4 mx-4">
            <div class="grow">
                <h1 class="text-xl">{{ title }}</h1>
            </div>
            <div class="flex-none">
                <BackButton :routeBack="route('dashboard.game-servers.index')" />
            </div>
        </div>
        <div class="bg-base-200 rounded-box p-4">
            text
        </div>
    </div>
</template>
