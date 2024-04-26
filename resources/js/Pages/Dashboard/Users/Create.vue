<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import BackButton from "@/Components/BackButton.vue";
// import {watch} from "vue";

defineOptions({
    layout: DashboardLayout
});
defineProps({
    title: String,
    roles: Array,
    // permissions: Array,
    genders: Array,
    countries: Array
});
const form = useForm({
    login: '',
    email: '',
    password: '',
    password_confirmation: '',
    role:'',
    // permissions:'',
});
const store = () => {
    form.post(route('dashboard.users.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
// watch(
//     () => form.role,
//     () => (form.permissions = form.role.permissions)
// );

</script>

<template>
    <Head :title="title" />
    <div class="ml-4">
        <div class="flex flex-1 items-center justify-between mb-4">
            <div><h1 class="text-xl">{{ title }}</h1></div>
            <div>
                <BackButton :routeBack="route('dashboard.users.index')" />
            </div>
        </div>
        <form @submit.prevent="store">
            <div class="bg-base-200 rounded-box p-4">
                    <div>
                        <div class="grid grid-cols-6 gap-x-6">
                            <div class="col-span-3">
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
                            <div class="col-span-3">
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
                        <div class="grid grid-cols-6 gap-x-6">
                            <div class="col-span-3">
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
                            <div class="col-span-3">
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
                    </div>
                    <div class="grid grid-cols-6 gap-x-6">
                        <div class="col-span-3">
                            <label for="role" class="label">
                                <span class="text-base label-text">{{ ('Роль пользователя') }}</span>
                            </label>
                            <select
                                id="role"
                                name="role"
                                class="select select-bordered select-sm w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                                v-model="form.role"
                            >
                                <option disabled value="">{{ ('Назначьте роль пользователю...') }}</option>
                                <option v-for="role in roles">{{ role.name }}</option>
                            </select>
                            <div v-show="form.errors.role">
                                <p class="text-sm text-red-600">{{ form.errors.role }}</p>
                            </div>
        <!--                    <div class="my-2">-->
        <!--                        <label class="label">-->
        <!--                            <span class="text-base label-text">{{ ('Доступные разрешения') }}</span>-->
        <!--                        </label>-->
        <!--                        <div class="flex flex-wrap gap-2 justify-start">-->
        <!--                            <div v-for="permission in permissions" >-->
        <!--                                <label class="label cursor-pointer">-->
        <!--                                    <input type="checkbox" class="checkbox mr-2" :value="permission.id" />-->
        <!--                                    <span class="label-text">{{ permission.name }}</span>-->
        <!--                                </label>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
                        </div>
                    </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 sm:px-6">
                <button class="btn btn-success normal-case">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 640 512"><path d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
                    {{ 'Создать' }}
                </button>
            </div>
        </form>
    </div>
</template>
