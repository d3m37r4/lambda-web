<script setup>
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    title: String,
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
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
            <div class="mb-4">
                Забыли пароль? Без проблем.
                Просто сообщите нам свой адрес электронной почты, и мы вышлем на него ссылку для сброса пароля;)
            </div>
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
                <div class="flex items-center justify-end">
                    <button class="btn btn-primary normal-case" :class="{ 'loading loading-spinner': form.processing }">{{ ('Восстановить пароль') }}</button>
                </div>
            </form>
        </div>
    </div>
</template>
