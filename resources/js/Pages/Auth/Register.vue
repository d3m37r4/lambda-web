<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";

defineProps({
    title: String
});

const form = useForm({
    login: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="title" />
    <div class="container w-full lg:max-w-lg space-y-4">
        <div class="flex items-center justify-between mx-4">
            <h1 class="text-xl">{{ title }}</h1>
        </div>
        <form @submit.prevent="submit">
            <div class="bg-base-200 rounded-box p-4">
                <div>
                    <label for="login" class="label">
                        <span class="text-base label-text">{{ ('Логин') }}</span>
                    </label>
                    <input
                        id="login"
                        type="text"
                        class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                        v-model="form.login"
                        required
                        autofocus
                        autocomplete="login"
                    />
                    <InputError :message="form.errors.login" />
                </div>
                <div>
                    <label for="email" class="label">
                        <span class="text-base label-text">{{ ('Эл. почта') }}</span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                        v-model="form.email"
                        required
                        autocomplete="email"
                    />
                    <InputError :message="form.errors.email" />
                </div>
                <div>
                    <label for="password" class="label">
                        <span class="text-base label-text">{{ ('Пароль') }}</span>
                    </label>
                    <input
                        id="password"
                        type="password"
                        class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                    <InputError :message="form.errors.password" />
                </div>
                <div>
                    <label for="password_confirmation" class="label">
                        <span class="text-base label-text">{{ ('Подтверждение пароля') }}</span>
                    </label>
                    <input
                        id="password_confirmation"
                        type="password"
                        class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>
                <div class="flex items-center justify-between my-4">
                    <Link :href="route('login')" class="text-sm text-gray-600 hover:underline hover:text-orange-500">
                        {{ ('У меня уже есть аккаунт') }}
                    </Link>
                </div>
            </div>
            <div class="flex justify-end m-4">
                <button class="btn btn-success normal-case" :disabled="!form.isDirty">{{ ('Зарегистрироваться') }}</button>
            </div>
        </form>
    </div>
</template>
