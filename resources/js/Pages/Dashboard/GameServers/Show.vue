<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import BackButton from "@/Components/BackButton.vue";

defineOptions({
    layout: DashboardLayout
});

const props = defineProps({
    title: String,
    gameServer: Object,
    serverInfo: Object,
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


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="">
                        <img :src="serverInfo.map_image" alt="Game Map" class=" h-auto rounded mb-4">
                        <p><strong>Map:</strong> {{ serverInfo.map_name }}</p>
                        <p><strong>Version:</strong> {{ serverInfo.version }}</p>
                        <p><strong>Status:</strong> {{ serverInfo.status }}</p>
                        <p><strong>Players Online:</strong> {{ serverInfo.players_online }} / {{ serverInfo.max_players }}</p>
                        <p><strong>Server IP:</strong> {{ serverInfo.server_ip }}:{{ serverInfo.server_port }}</p>
                        <p><strong>Description:</strong> {{ serverInfo.description }}</p>
                    </div>
                    <div class="">
                        <h2 class="text-2xl font-bold mb-4">Server Status</h2>
                        <div class="flex items-center mb-4">
                            <div class="w-4 h-4 rounded-full mr-2" :class="serverInfo.status === 'Online' ? 'bg-green-500' : 'bg-red-500'"></div>
                            <span>{{ serverInfo.status }}</span>
                        </div>
                        <h2 class="text-2xl font-bold mb-4">Players Online</h2>
                        <div class="relative pt-1">
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                                <div :style="{ width: serverInfo.players_online / serverInfo.max_players * 100 + '%' }" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                            </div>
                            <div class="flex justify-between">
                                <span>{{ serverInfo.players_online }}</span>
                                <span>{{ serverInfo.max_players }}</span>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</template>
