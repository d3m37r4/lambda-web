<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";

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
    <div class="container w-full lg:max-w-lg space-y-4">
        <div class="flex items-center justify-between mx-4">
            <h1 class="text-xl">{{ $t(title) }}</h1>
        </div>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <form @submit.prevent="submit">
            <div class="bg-base-200 rounded-box p-4">
                <div>
                    <label for="email" class="label">
                        <span class="text-base label-text">{{ $t('auth.email') }}</span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="login"
                    />
                    <InputError :message="form.errors.email" />
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
                        autocomplete="login"
                    />
                    <InputError :message="form.errors.password" />
                </div>
                <div class="flex items-center justify-between my-4">
                    <label class="flex items-center">
                        <input type="checkbox" class="checkbox" v-model="form.remember"/>
                        <span class="ms-2 text-sm">{{ ('Запомнить меня') }}</span>
                    </label>
                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 hover:underline hover:text-orange-500">
                        {{ ('Забыли свой пароль?') }}
                    </Link>
                </div>
            </div>
            <div class="flex justify-end m-4">
                <button class="btn btn-success normal-case" :disabled="!form.isDirty">{{ ('Войти') }}</button>
            </div>
        </form>
    </div>
</template>
