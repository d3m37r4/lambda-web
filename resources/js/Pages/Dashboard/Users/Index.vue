<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import Pagination from '@/Components/Pagination.vue';
import ConfirmDeleteUser from '@/Components/Dashboard/ConfirmDeleteUser.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineOptions({
    layout: DashboardLayout
});

defineProps({
    title: String,
    users: Object,
});

const selected = ref([]);
const toggle = ref(false);
const selectAll = (users) => {
    if(toggle.value) {
        let buffer = [];
        users.forEach(function (user) {
            buffer.push(user.id);
        });
        selected.value = buffer;
    } else {
        selected.value = [];
    }
}

const deletedUser = ref();
const isOpenModal = ref(false);
const showModal = (id) => {
    isOpenModal.value = true;
    deletedUser.value = id;
}
</script>

<template>
    <Head :title="title" />
    <ConfirmDeleteUser v-model="isOpenModal" :id="deletedUser"/>
    <div class="ml-4">
        <h1 class="mb-4 text-xl">{{ title }}</h1>
        <div class="flex flex-1 items-center justify-between mb-4">
            <div>
                <div class="join">
                    <div>
                        <div>
                            <input class="input input-sm join-item input-bordered" placeholder="Введите текст..."/>
                        </div>
                    </div>
                    <select class="select select-sm join-item select-bordered">
                        <option disabled selected>Фильтр</option>
                        <option>Логин</option>
                        <option>E-mail</option>
                        <option>Роль</option>
                    </select>
                    <div>
                        <button class="btn btn-sm join-item btn-neutral">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" /></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <Link :href="route('dashboard.users.create')" class="btn btn-sm btn-success normal-case">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 640 512"><path d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
                    {{ 'Новый пользователь' }}
                </Link>
            </div>
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
                                        :checked="selected.length === users.data.length"
                                        v-model="toggle"
                                        @change="selectAll(users.data)"
                                    />
                                </label>
                            </th>
                            <th>#</th>
                            <th>{{ ('Пользователь') }}</th>
                            <th>{{ ('Роль') }}</th>
                            <th>{{ ('Зарегистрирован') }}</th>
                            <th>{{ ('Действия') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users.data" class="hover:bg-base-300" :class="{ 'bg-base-300': selected.includes(user.id) }">
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" v-model="selected" :value="user.id"/>
                                </label>
                            </th>
                            <td>
                                {{ user.id }}
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-12 h-12">
                                            <img src="https://daisyui.com/tailwind-css-component-profile-2@56w.png" :alt="user.login" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ user.login }}</div>
                                        <div class="text-sm opacity-50">
                                            <a :href="`mailto:${user.email}`">{{ user.email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-secondary rounded">{{ user.role }}</div>
                            </td>
                            <td>{{ user.created_at }}</td>
                            <th>
                                <button class="btn btn-sm btn-circle btn-outline btn-info me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-1.641-1.359-3-3-3z"/><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z"/></svg>
                                </button>
                                <button class="btn btn-sm btn-circle btn-outline btn-accent me-1">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><g id="info"/><g id="icons"><g id="edit"><path d="M2,20c0,1.1,0.9,2,2,2h2.6L2,17.4V20z"/><path d="M21.6,5.6l-3.2-3.2c-0.8-0.8-2-0.8-2.8,0l-0.2,0.2C15,3,15,3.6,15.4,4L20,8.6c0.4,0.4,1,0.4,1.4,0l0.2-0.2    C22.4,7.6,22.4,6.4,21.6,5.6z"/><path d="M14,5.4c-0.4-0.4-1-0.4-1.4,0l-9.1,9.1C3,15,3,15.6,3.4,16L8,20.6c0.4,0.4,1,0.4,1.4,0l9.1-9.1c0.4-0.4,0.4-1,0-1.4    L14,5.4z"/></g></g></svg>
                                </button>
                                <button
                                    @click="showModal(user.id)"
                                    class="btn btn-sm btn-circle btn-outline btn-error"
                                >
                                    <svg class="h-5 w-5" viewBox="0 0 48 48" fill="currentColor"><path d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z"/><path d="M0 0h48v48h-48z" fill="none"/></svg>
                                </button>
                            </th>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                <label>
                                    <input
                                        type="checkbox"
                                        class="checkbox"
                                        :checked="selected.length === users.data.length"
                                        v-model="toggle"
                                        @change="selectAll(users.data)"
                                    />
                                </label>
                            </th>
                            <th>#</th>
                            <th>{{ ('Пользователь') }}</th>
                            <th>{{ ('Роль') }}</th>
                            <th>{{ ('Зарегистрирован') }}</th>
                            <th>{{ ('Действия') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div>
            <Transition name="fade">
                <div v-if="selected.length > 0" class="py-3">
                    <div>
                        <span>Отмечено пользователей: {{ selected.length }}</span>
                    </div>
                    <div class="py-3">
                        <button class="btn btn-sm btn-error normal-case">{{ 'Удалить отмеченные' }}</button>
                    </div>
                </div>
            </Transition>
        </div>
        <Pagination :links="users.links" :items="users" />
    </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
