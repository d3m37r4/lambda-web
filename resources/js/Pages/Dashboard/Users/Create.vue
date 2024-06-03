<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { useForm } from '@inertiajs/vue3';
import BackButton from "@/Components/BackButton.vue";
import CreateButton from "@/Components/CreateButton.vue";
// import {ref} from "vue";
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
    role: '',
    // permissions: '',
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
    <div class="ml-4">
        <div class="flex items-center justify-between mx-4">
            <h1 class="text-xl">{{ title }}</h1>
            <BackButton :routeBack="route('dashboard.users.index')" />
        </div>
        <form @submit.prevent="store">
            <div class="bg-base-200 rounded-box my-4 p-4">
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
                        <div class="col-span-3">
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
                    <div class="grid grid-cols-6 gap-x-6">
                        <div class="col-span-3">
                            <label for="password" class="label">
                                <span class="text-base label-text">{{ ('Пароль') }}</span>
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
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
                                class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
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
                            class="select select-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.role"
                        >
                            <option disabled value="">{{ ('Назначьте роль пользователю...') }}</option>
                            <option v-for="role in roles">{{ role.name }}</option>
                        </select>
                        <div v-show="form.errors.role">
                            <p class="text-sm text-red-600">{{ form.errors.role }}</p>
                        </div>
                    </div>
                </div>
                <div class="my-2">
<!--                    <div class="collapse collapse-plus border border-neutral">-->
<!--                        <input type="checkbox" />-->
<!--                        <div class="collapse-title">-->
<!--                            Переопределить разрешения для текущего пользователя-->
<!--                        </div>-->
<!--                        <div class="collapse-content">-->
<!--                            <label class="label">-->
<!--                                <span class="text-base label-text">{{ ('Доступные разрешения') }}</span>-->
<!--                            </label>-->
<!--                            <div class="flex flex-wrap gap-2 justify-start">-->
<!--                                <div v-for="permission in permissions">-->
<!--                                    <label class="label cursor-pointer">-->
<!--                                        <input-->
<!--                                            type="checkbox"-->
<!--                                            class="checkbox mr-2"-->
<!--                                            v-model="selected"-->
<!--                                            :value="permission.id"-->
<!--                                        />-->
<!--                                        <span class="label-text">{{ permission.name }}</span>-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div v-show="form.errors.permissions">-->
<!--                                <p class="text-sm text-red-600">{{ form.errors.permissions }}</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <label class="label">-->
<!--                        <span class="text-base label-text">{{ ('Доступные разрешения') }}</span>-->
<!--                    </label>-->
<!--                    <div class="flex flex-wrap gap-2 justify-start">-->
<!--                        <div v-for="permission in permissions">-->
<!--                            <label class="label cursor-pointer">-->
<!--                                <input-->
<!--                                    type="checkbox"-->
<!--                                    class="checkbox mr-2"-->
<!--                                    v-model="form.permissions"-->
<!--                                    :value="permission.id"-->
<!--                                />-->
<!--                                <span class="label-text">{{ permission.name }}</span>-->
<!--                            </label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div v-show="form.errors.permissions">-->
<!--                        <p class="text-sm text-red-600">{{ form.errors.permissions }}</p>-->
<!--                    </div>-->
                </div>
            </div>
            <div class="flex justify-end m-4">
                <CreateButton />
            </div>
        </form>
    </div>
</template>
