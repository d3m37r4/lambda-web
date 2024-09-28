<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

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
    <div class="container w-full lg:max-w-lg">
        <h1 class="mb-4 text-xl">{{ title }}</h1>
        <div class="p-4 bg-base-200 rounded-box">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="label">
                        <span class="text-base label-text">Login</span>
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
                    <div v-show="form.errors.login">
                        <p class="text-sm text-red-600">{{ form.errors.login }}</p>
                    </div>
                </div>
                <div>
                    <label class="label">
                        <span class="text-base label-text">Email</span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <div v-show="form.errors.email">
                        <p class="text-sm text-red-600">{{ form.errors.email }}</p>
                    </div>
                </div>
                <div>
                    <label class="label">
                        <span class="text-base label-text">Password</span>
                    </label>
                    <input
                        id="password"
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
                <div>
                    <label class="label">
                        <span class="text-base label-text">Confirm Password</span>
                    </label>
                    <input
                        id="password_confirmation"
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
                <div class="flex items-center justify-between">
                    <Link :href="route('login')" class="text-sm text-gray-600 hover:underline hover:text-orange-500">
                        {{ ('У меня уже есть аккаунт') }}
                    </Link>
                    <button class="btn btn-success normal-case" :class="{ 'loading loading-spinner': form.processing }">{{ ('Зарегистрироваться') }}</button>
                </div>
            </form>
        </div>
    </div>
</template>
