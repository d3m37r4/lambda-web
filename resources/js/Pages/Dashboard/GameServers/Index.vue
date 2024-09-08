<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { selectAll } from '@/Utils/selection';
import Pagination from '@/Components/Pagination.vue';
import ConfirmDeleteGameServer from '@/Components/Dashboard/ConfirmDeleteGameServer.vue';
import SearchForm from "@/Components/Dashboard/SearchForm.vue";
import DeleteSelectedItemsForm from "@/Components/Dashboard/DeleteSelectedItemsForm.vue";
import CreateButton from "@/Components/CreateButton.vue";

defineOptions({
    layout: DashboardLayout
});

defineProps({
    title: String,
    game_servers: Object
});

const selectedGameServers = ref([]);
const isSelectAllChecked = ref(false);

const selectAllItems = (gameServers) => {
    selectAll(gameServers, selectedGameServers, isSelectAllChecked.value);
}

const deleteSelectedItems = () => {
    selectedGameServers.value = [];
}

const targetGameServer = ref();
const showModalConfirmDelete = ref(false);

const confirmDeleteGameServer = (id) => {
    showModalConfirmDelete.value = true;
    targetGameServer.value = id;
}
</script>

<template>
    <ConfirmDeleteGameServer
        v-model="showModalConfirmDelete"
        :game_server="targetGameServer"
        :currentPage="game_servers.current_page"
        @deleteSelectedItems="deleteSelectedItems" />
    <div class="ml-4 space-y-4">
        <div class="flex items-center space-x-4 mx-4">
            <div class="grow">
                <h1 class="text-xl">{{ title }}</h1>
            </div>
            <div class="flex-none">
                <SearchForm />
            </div>
            <div class="flex-none">
                <CreateButton :routeCreate="route('dashboard.roles.create')" />
            </div>
        </div>
        <div class="space-x-4 mx-4">
            <DeleteSelectedItemsForm
                :selected="selectedGameServers"
                :routeAction="route('dashboard.game-servers.delete-selected')"
                :currentPage="game_servers.current_page"
                @deleteSelectedItems="deleteSelectedItems" />
        </div>
        <div class="bg-base-200 rounded-box p-4">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <label>
                                    <input
                                        type="checkbox"
                                        class="checkbox"
                                        :checked="selectedGameServers.length === game_servers.data.length"
                                        v-model="isSelectAllChecked"
                                        @change="selectAllItems(game_servers.data)" />
                                </label>
                            </th>
                            <th>#</th>
                            <th>{{ ('Сервер') }}</th>
                            <th>{{ ('Онлайн') }}</th>
                            <th>{{ ('Добавлен') }}</th>
                            <th>{{ ('Последнее обновление') }}</th>
                            <th>{{ ('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="game_server in game_servers.data" class="hover:bg-base-300" :class="{ 'bg-base-300': selectedGameServers.includes(game_server.id) }">
                            <td>
                                <label>
                                    <input type="checkbox" class="checkbox" v-model="selectedGameServers" :value="game_server.id"/>
                                </label>
                            </td>
                            <td>
                                {{ game_server.id }}
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar indicator">
                                        <span class="indicator-item badge badge-sm badge-success"></span>
                                        <div class="mask mask-squircle w-13 h-12">
                                            <img src="https://steamuserimages-a.akamaihd.net/ugc/771724021898742152/3FAE420233A940A966B41CD934A52DFBE1ED9E08/" :alt="game_server.name" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ game_server.name }}</div>
                                        <div class="text-sm opacity-50">
                                            {{ game_server.full_address }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <svg class="w-12 h-12 text-orange-500" viewBox="0 0 36 36">
                                    <path
                                        class="text-gray-300"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="4.0"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="3.8"
                                        stroke-linecap="round"
                                        stroke-dasharray="30, 100"
                                        d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831">
                                        <animate attributeName="stroke-dasharray" from="0, 100" to="30, 100" dur="0.5s" fill="freeze" />
                                    </path>
                                    <text fill="currentColor" class="text-[0.52rem] text-gray-400" x="50%" y="56%" text-anchor="middle">
                                        13/32
                                    </text>
                                </svg>
                            </td>
                            <td>{{ game_server.created_at }}</td>
                            <td>{{ game_server.updated_at }}</td>
                            <td>
                                <div class="lg:tooltip" data-tip="О сервере">
                                    <Link :href="route('dashboard.game-servers.show', game_server.id)" class="btn btn-sm btn-circle btn-outline btn-info me-1">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-1.641-1.359-3-3-3z"/><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z"/></svg>
                                    </Link>
                                </div>
                                <div class="lg:tooltip" data-tip="Редактировать">
                                    <Link :href="route('dashboard.game-servers.edit', game_server.id)" class="btn btn-sm btn-circle btn-outline btn-accent me-1">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><g id="info"/><g id="icons"><g id="edit"><path d="M2,20c0,1.1,0.9,2,2,2h2.6L2,17.4V20z"/><path d="M21.6,5.6l-3.2-3.2c-0.8-0.8-2-0.8-2.8,0l-0.2,0.2C15,3,15,3.6,15.4,4L20,8.6c0.4,0.4,1,0.4,1.4,0l0.2-0.2    C22.4,7.6,22.4,6.4,21.6,5.6z"/><path d="M14,5.4c-0.4-0.4-1-0.4-1.4,0l-9.1,9.1C3,15,3,15.6,3.4,16L8,20.6c0.4,0.4,1,0.4,1.4,0l9.1-9.1c0.4-0.4,0.4-1,0-1.4    L14,5.4z"/></g></g></svg>
                                    </Link>
                                </div>
                                <div class="lg:tooltip" data-tip="Удалить">
                                    <button @click="confirmDeleteGameServer(game_server.id)" class="btn btn-sm btn-circle btn-outline btn-error">
                                        <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>
                            <label>
                                <input
                                    type="checkbox"
                                    class="checkbox"
                                    :checked="selectedGameServers.length === game_servers.data.length"
                                    v-model="isSelectAllChecked"
                                    @change="selectAllItems(game_servers.data)" />
                            </label>
                        </th>
                        <th>#</th>
                        <th>{{ ('Сервер') }}</th>
                        <th>{{ ('Онлайн') }}</th>
                        <th>{{ ('Добавлен') }}</th>
                        <th>{{ ('Последнее обновление') }}</th>
                        <th>{{ ('Действия') }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <Pagination :links="game_servers.links" :items="game_servers" />
    </div>
</template>
