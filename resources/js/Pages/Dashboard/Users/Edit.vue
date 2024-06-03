<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { useForm } from '@inertiajs/vue3';
import BackButton from "@/Components/BackButton.vue";
import UpdateButton from "@/Components/UpdateButton.vue";

defineOptions({
    layout: DashboardLayout
});

const props = defineProps({
    title: String,
    user: Object,
    roles: Array,
    permissions: Array,
});
const form = useForm({
    login: props.user.login,
    email: props.user.email,
    password: '',
    role: props.user.role,
});

const submit = () => {
    form.post(route('dashboard.users.store'));
};
</script>

<template>
    <div class="ml-4">
        <div class="flex items-center justify-between mx-4">
            <h1 class="text-xl">{{ title }}</h1>
            <BackButton :routeBack="route('dashboard.users.index')" />
        </div>
        <form @submit.prevent="update">
            <div class="bg-base-200 rounded-box my-4 p-4">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 mb-4">
                    <div class="sm:col-span-3">
                        <label for="login" class="label">
                            <span class="text-base label-text">{{ ('Логин') }}</span>
                        </label>
                        <input
                            id="login"
                            name="login"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
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
                            class="input input-bordered  w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
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
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 mb-4">
                    <div class="sm:col-span-3">
                        <label for="password" class="label">
                            <span class="text-base label-text">{{ ('Пароль') }}</span>
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.password"
                            autofocus
                            autocomplete="username"
                        />
                        <div v-show="form.errors.password">
                            <p class="text-sm text-red-600">{{ form.errors.password }}</p>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="role" class="label">
                            <span class="text-base label-text">{{ ('Роль пользователя') }}</span>
                        </label>
                        <select
                            id="role"
                            name="role"
                            class="select select-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.role"
                            required
                            autofocus
                        >
                            <option disabled>{{ ('Назначьте роль пользователю...') }}</option>
                            <option v-for="role in roles">{{ role.name }}</option>
                        </select>
                        <div v-show="form.errors.role">
                            <p class="text-sm text-red-600">{{ form.errors.role }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end m-4">
                <UpdateButton />
            </div>
        </form>
    </div>
</template>
