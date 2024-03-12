<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import BackButton from "@/Components/BackButton.vue";

defineOptions({
    layout: DashboardLayout
});
defineProps({
    title: String,
    roles: Array,
});
const form = useForm({
    login: '',
    email: '',
    password: '',
    password_confirmation: '',
    role:''
});
const submit = () => {
    form.post(route('dashboard.users.create'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="title" />
    <div class="ml-4">
        <div class="flex flex-1 items-center justify-between mb-4">
            <div><h1 class="text-xl">{{ title }}</h1></div>
            <div>
                <BackButton :route="route('dashboard.users.index')" />
            </div>
        </div>
        <div class="bg-base-200 rounded-box p-4">
            <form @submit.prevent="store">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="login" class="label">
                            <span class="text-base label-text">{{ ('Логин') }}</span>
                        </label>
                        <input
                            id="login"
                            name="login"
                            type="text"
                            class="input input-bordered input-sm w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.login"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <div v-show="form.errors.login">
                            <p class="text-sm text-red-600">{{ form.errors.login }}</p>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="email" class="label">
                            <span class="text-base label-text">{{ ('Эл. почта') }}</span>
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="input input-bordered input-sm w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <div v-show="form.errors.email">
                            <p class="text-sm text-red-600">{{ form.errors.email }}</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="password" class="label">
                            <span class="text-base label-text">{{ ('Пароль') }}</span>
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="input input-bordered input-sm w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.password"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <div v-show="form.errors.password">
                            <p class="text-sm text-red-600">{{ form.errors.password }}</p>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="password_confirmation" class="label">
                            <span class="text-base label-text">{{ ('Подтверждение пароля') }}</span>
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="input input-bordered input-sm w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.password_confirmation"
                            required
                            autofocus
                            autocomplete="new-password"
                        />
                        <div v-show="form.errors.password_confirmation">
                            <p class="text-sm text-red-600">{{ form.errors.password_confirmation }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="role" class="label">
                        <span class="text-base label-text">{{ ('Роль пользователя') }}</span>
                    </label>
                    <select
                        id="role"
                        name="role"
                        type="text"
                        class="select select-bordered select-sm w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                        v-model="form.role"
                    >
                        <option disabled selected>{{ ('Назначьте роль пользователю...') }}</option>
                        <option v-for="role in roles">{{ role.name }}</option>
                    </select>
                    <div v-show="form.errors.role">
                        <p class="text-sm text-red-600">{{ form.errors.role }}</p>
                    </div>
                </div>
            </form>
        </div>
        <div>
            Добавить пользователя
        </div>
    </div>
</template>
