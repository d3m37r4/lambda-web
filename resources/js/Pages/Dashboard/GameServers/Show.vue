<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import BackButton from "@/Components/Buttons/BackButton.vue";
import CreateButton from "@/Components/Buttons/CreateButton.vue";

defineOptions({
    layout: DashboardLayout
});

const props = defineProps({
    title: String,
    gameServer: Object,
    serverInfo: Object,
    punishmentReasons: Object,
});

const activeTab = ref('tab-players');

const isActive = (tabId) => {
    return activeTab.value === tabId;
};

</script>

<template>
    <div class="ml-4 space-y-4">
        <div class="flex items-center space-x-4 mx-4">
            <div class="grow">
                <h1 class="text-xl">{{ title }}</h1>
            </div>
            <div class="flex-none">
                <BackButton title="Назад" :href="route('dashboard.game-servers.index')" />
            </div>
        </div>
        <div class="bg-base-200 rounded-box p-4">


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="">
                        <img :src="serverInfo.map_image" alt="Game Map" class="h-auto rounded mb-4">
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

        <ul class="menu menu-horizontal bg-base-200 flex gap-2 rounded-box">
            <li class="flex-1">
                <a class="flex justify-center"
                   @click="activeTab = 'tab-players'"
                   :class="{ 'active': isActive('tab-players') }">{{ ('Игроки онлайн') }}</a>
            </li>
            <li class="flex-1">
                <a class="flex justify-center"
                   @click="activeTab = 'tab-access-groups'"
                   :class="{ 'active': isActive('tab-access-groups') }">{{ ('Группы доступов') }}</a>
            </li>
            <li class="flex-1">
                <a class="flex justify-center"
                   @click="activeTab = 'tab-reasons'"
                   :class="{ 'active': isActive('tab-reasons') }">{{ ('Причины наказаний') }}</a>
            </li>
            <li class="flex-1">
                <a class="flex justify-center"
                   @click="activeTab = 'tab-accesses'"
                   :class="{ 'active': isActive('tab-accesses') }">{{ ('Доступы') }}</a>
            </li>
        </ul>

        <div id="tab-players" v-show="isActive('tab-players')" class="bg-base-200 rounded-box p-4">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ ('Игрок') }}</th>
                        <th>{{ ('Начало сессии') }}</th>
                        <th>{{ ('Длительность сессии') }}</th>
                        <th>{{ ('Действия') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-base-300">
                        <td>{{('1')}}</td>
                        <td>{{('Player')}}</td>
                        <td>{{('26.11.2024 - 07:49:53')}}</td>
                        <td>{{('31 мин.')}}</td>
                        <td>
                            <div class="lg:tooltip" data-tip="Действие">
                                <button @click="" class="btn btn-sm btn-circle btn-outline btn-info me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-1.641-1.359-3-3-3z"/><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z"/></svg>
                                </button>
                            </div>
                            <div class="lg:tooltip" data-tip="Действие">
                                <Link  class="btn btn-sm btn-circle btn-outline btn-accent me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><g id="info"/><g id="icons"><g id="edit"><path d="M2,20c0,1.1,0.9,2,2,2h2.6L2,17.4V20z"/><path d="M21.6,5.6l-3.2-3.2c-0.8-0.8-2-0.8-2.8,0l-0.2,0.2C15,3,15,3.6,15.4,4L20,8.6c0.4,0.4,1,0.4,1.4,0l0.2-0.2    C22.4,7.6,22.4,6.4,21.6,5.6z"/><path d="M14,5.4c-0.4-0.4-1-0.4-1.4,0l-9.1,9.1C3,15,3,15.6,3.4,16L8,20.6c0.4,0.4,1,0.4,1.4,0l9.1-9.1c0.4-0.4,0.4-1,0-1.4    L14,5.4z"/></g></g></svg>
                                </Link>
                            </div>
                            <div class="lg:tooltip" data-tip="Действие">
                                <button @click="" class="btn btn-sm btn-circle btn-outline btn-error">
                                    <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>{{ ('Игрок') }}</th>
                        <th>{{ ('Начало сессии') }}</th>
                        <th>{{ ('Длительность сессии') }}</th>
                        <th>{{ ('Действия') }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div id="tab-access-groups" v-show="isActive('tab-access-groups')" class="bg-base-200 rounded-box p-4">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ ('Группа') }}</th>
                        <th>{{ ('Флаги') }}</th>
                        <th>{{ ('Префикс') }}</th>
                        <th>{{ ('Действия') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-base-300">
                        <td>{{('1')}}</td>
                        <td>{{('Admin')}}</td>
                        <td>{{('abcdef')}}</td>
                        <td>{{('Admin')}}</td>
                        <td>
                            <div class="lg:tooltip" data-tip="Действие">
                                <button @click="" class="btn btn-sm btn-circle btn-outline btn-info me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-1.641-1.359-3-3-3z"/><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z"/></svg>
                                </button>
                            </div>
                            <div class="lg:tooltip" data-tip="Действие">
                                <Link  class="btn btn-sm btn-circle btn-outline btn-accent me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><g id="info"/><g id="icons"><g id="edit"><path d="M2,20c0,1.1,0.9,2,2,2h2.6L2,17.4V20z"/><path d="M21.6,5.6l-3.2-3.2c-0.8-0.8-2-0.8-2.8,0l-0.2,0.2C15,3,15,3.6,15.4,4L20,8.6c0.4,0.4,1,0.4,1.4,0l0.2-0.2    C22.4,7.6,22.4,6.4,21.6,5.6z"/><path d="M14,5.4c-0.4-0.4-1-0.4-1.4,0l-9.1,9.1C3,15,3,15.6,3.4,16L8,20.6c0.4,0.4,1,0.4,1.4,0l9.1-9.1c0.4-0.4,0.4-1,0-1.4    L14,5.4z"/></g></g></svg>
                                </Link>
                            </div>
                            <div class="lg:tooltip" data-tip="Действие">
                                <button @click="" class="btn btn-sm btn-circle btn-outline btn-error">
                                    <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>{{ ('Группа') }}</th>
                        <th>{{ ('Флаги') }}</th>
                        <th>{{ ('Префикс') }}</th>
                        <th>{{ ('Действия') }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div id="tab-reasons" v-show="isActive('tab-reasons')" class="">
            <div class="pb-4">
                <CreateButton
                    title="Добавить"
                    class="btn-sm"
                    :href="route('dashboard.game-servers.punishment-reasons.create', gameServer.id)" />
            </div>
            <div v-if="punishmentReasons.length > 0" class="bg-base-200 rounded-box p-4">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ ('#') }}</th>
                            <th>{{ ('Название') }}</th>
                            <th>{{ ('Время действия') }}</th>
                            <th>{{ ('Время создания') }}</th>
                            <th>{{ ('Последнее обновление') }}</th>
                            <th>{{ ('Действия') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(punishmentReason, index) in punishmentReasons" class="hover:bg-base-300">
                            <td>{{ index + 1 }}</td>
                            <td>{{ punishmentReason.name }}</td>
                            <td>{{ punishmentReason.time }}</td>
                            <td>{{ punishmentReason.created_at }}</td>
                            <td>{{ punishmentReason.updated_at }}</td>
                            <td>
                                <div class="lg:tooltip" data-tip="Редактировать">
                                    <Link :href="route('dashboard.game-servers.punishment-reasons.edit', [gameServer.id, punishmentReason.id])" class="btn btn-sm btn-circle btn-outline btn-accent me-1">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><g id="info"/><g id="icons"><g id="edit"><path d="M2,20c0,1.1,0.9,2,2,2h2.6L2,17.4V20z"/><path d="M21.6,5.6l-3.2-3.2c-0.8-0.8-2-0.8-2.8,0l-0.2,0.2C15,3,15,3.6,15.4,4L20,8.6c0.4,0.4,1,0.4,1.4,0l0.2-0.2    C22.4,7.6,22.4,6.4,21.6,5.6z"/><path d="M14,5.4c-0.4-0.4-1-0.4-1.4,0l-9.1,9.1C3,15,3,15.6,3.4,16L8,20.6c0.4,0.4,1,0.4,1.4,0l9.1-9.1c0.4-0.4,0.4-1,0-1.4    L14,5.4z"/></g></g></svg>
                                    </Link>
                                </div>
                                <div class="lg:tooltip" data-tip="Действие">
                                    <button @click="" class="btn btn-sm btn-circle btn-outline btn-error">
                                        <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>{{ ('#') }}</th>
                            <th>{{ ('Название') }}</th>
                            <th>{{ ('Время действия') }}</th>
                            <th>{{ ('Время создания') }}</th>
                            <th>{{ ('Последнее обновление') }}</th>
                            <th>{{ ('Действия') }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div v-else class="alert alert-info rounded-box">
                <svg class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ 'Причины наказаний для этого сервера еще не заданы.' }}</span>
            </div>
        </div>

        <div id="tab-accesses" v-show="isActive('tab-accesses')" class="bg-base-200 rounded-box p-4">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ ('#') }}</th>
                        <th>{{ ('ID') }}</th>
                        <th>{{ ('Ключ доступа') }}</th>
                        <th>{{ ('Описание') }}</th>
                        <th>{{ ('Действия') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-base-300">
                        <td>{{('1')}}</td>
                        <td>{{('111')}}</td>
                        <td>{{('Access key')}}</td>
                        <td>{{('Description')}}</td>
                        <td>
                            <div class="lg:tooltip" data-tip="Действие">
                                <button @click="" class="btn btn-sm btn-circle btn-outline btn-info me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-1.641-1.359-3-3-3z"/><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z"/></svg>
                                </button>
                            </div>
                            <div class="lg:tooltip" data-tip="Действие">
                                <Link  class="btn btn-sm btn-circle btn-outline btn-accent me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><g id="info"/><g id="icons"><g id="edit"><path d="M2,20c0,1.1,0.9,2,2,2h2.6L2,17.4V20z"/><path d="M21.6,5.6l-3.2-3.2c-0.8-0.8-2-0.8-2.8,0l-0.2,0.2C15,3,15,3.6,15.4,4L20,8.6c0.4,0.4,1,0.4,1.4,0l0.2-0.2    C22.4,7.6,22.4,6.4,21.6,5.6z"/><path d="M14,5.4c-0.4-0.4-1-0.4-1.4,0l-9.1,9.1C3,15,3,15.6,3.4,16L8,20.6c0.4,0.4,1,0.4,1.4,0l9.1-9.1c0.4-0.4,0.4-1,0-1.4    L14,5.4z"/></g></g></svg>
                                </Link>
                            </div>
                            <div class="lg:tooltip" data-tip="Действие">
                                <button @click="" class="btn btn-sm btn-circle btn-outline btn-error">
                                    <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>{{ ('#') }}</th>
                        <th>{{ ('ID') }}</th>
                        <th>{{ ('Ключ доступа') }}</th>
                        <th>{{ ('Описание') }}</th>
                        <th>{{ ('Действия') }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</template>
