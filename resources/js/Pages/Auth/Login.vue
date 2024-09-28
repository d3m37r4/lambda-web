<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    title: String,
    canResetPassword: Boolean,
    status: String,
});
const form = useForm({
    email: '',
    password: '',
    remember: false,
});
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head :title="title" />
    <div class="container w-full lg:max-w-lg">
        <h1 class="mb-4 text-xl">{{ title }}</h1>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="p-4 bg-base-200 rounded-box">
            <form @submit.prevent="submit" class="space-y-4">
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
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="checkbox" v-model="form.remember"/>
                        <span class="ms-2 text-sm">{{ ('Запомнить меня') }}</span>
                    </label>
                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 hover:underline hover:text-orange-500">
                        {{ ('Забыли свой пароль?') }}
                    </Link>
                </div>
                <div class="flex items-center justify-end">
                    <button class="btn btn-success normal-case" :class="{ 'loading loading-spinner': form.processing }">{{ ('Войти') }}</button>
                </div>
            </form>
        </div>
    </div>
</template>
