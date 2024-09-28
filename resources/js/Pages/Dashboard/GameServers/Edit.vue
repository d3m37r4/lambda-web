<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { useForm } from '@inertiajs/vue3';
import { useAuthToken } from '@/Composables/useAuthToken.js';
import InputError from "@/Components/InputError.vue";
import BackButton from "@/Components/BackButton.vue";
import UpdateButton from "@/Components/UpdateButton.vue";
import CopyToClipboard from "@/Components/CopyToClipboard.vue";

defineOptions({
    layout: DashboardLayout
});

const props = defineProps({
    title: String,
    gameServer: Object,
});

const form = useForm({
    name: props.gameServer.name,
    ip: props.gameServer.ip,
    port: props.gameServer.port,
    auth_token: '',
    rcon: '',
});

const { generatingAuthToken, generateAuthToken } = useAuthToken(form);

const update = () => {
    form.put(route('dashboard.game-servers.update', props.gameServer));
}
</script>

<template>
    <div class="ml-4 space-y-4">
        <div class="flex items-center space-x-4 mx-4">
            <div class="grow">
                <h1 class="text-xl">{{ title }}</h1>
            </div>
            <div class="flex-none">
                <BackButton :routeBack="route('dashboard.game-servers.index')" />
            </div>
        </div>
        <form @submit.prevent="update">
            <div class="bg-base-200 rounded-box p-4">
                <div class="grid grid-cols-6 gap-x-6">
                    <div class="col-span-3">
                        <label for="name" class="label">
                            <span class="text-base label-text">{{ ('Название сервера') }}</span>
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.name"
                            required
                            autofocus />
                        <InputError :message="form.errors.name"/>
                    </div>
                    <div class="col-span-3">
                        <label for="rcon" class="label">
                            <span class="text-base label-text">{{ ('RCON пароль') }}</span>
                        </label>
                        <input
                            id="rcon"
                            name="rcon"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.rcon" />
                        <InputError :message="form.errors.rcon"/>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-x-6">
                    <div class="col-span-3">
                        <label for="ip" class="label">
                            <span class="text-base label-text">{{ ('IP адрес') }}</span>
                        </label>
                        <input
                            id="ip"
                            name="ip"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.ip" />
                        <InputError :message="form.errors.ip"/>
                    </div>
                    <div class="col-span-3">
                        <label for="port" class="label">
                            <span class="text-base label-text">{{ ('Порт') }}</span>
                        </label>
                        <input
                            id="port"
                            name="port"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.port" />
                        <InputError :message="form.errors.port"/>
                    </div>
                </div>
                <div>
                    <label for="auth_token" class="label">
                        <span class="text-base label-text">{{ ('Токен авторизации') }}</span>
                    </label>
                    <div class="join w-full">
                        <input
                            id="auth_token"
                            name="auth_token"
                            type="text"
                            class="input join-item input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.auth_token"
                            readonly />
                        <div class="lg:tooltip" data-tip="Скопировать токен">
                            <CopyToClipboard :text="form.auth_token">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 512 512"><path d="M448 0H224C188.7 0 160 28.65 160 64v224c0 35.35 28.65 64 64 64h224c35.35 0 64-28.65 64-64V64C512 28.65 483.3 0 448 0zM464 288c0 8.822-7.178 16-16 16H224C215.2 304 208 296.8 208 288V64c0-8.822 7.178-16 16-16h224c8.822 0 16 7.178 16 16V288zM304 448c0 8.822-7.178 16-16 16H64c-8.822 0-16-7.178-16-16V224c0-8.822 7.178-16 16-16h64V160H64C28.65 160 0 188.7 0 224v224c0 35.35 28.65 64 64 64h224c35.35 0 64-28.65 64-64v-64h-48V448z"/></svg>
                            </CopyToClipboard>
                        </div>
                        <div class="lg:tooltip" data-tip="Сгенерировать новый токен">
                            <button type="button" @click="generateAuthToken" class="btn join-item btn-neutral" :disabled="generatingAuthToken">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="-1.5 -2.5 24 24" ><path d="m4.859 5.308 1.594-.488a1 1 0 0 1 .585 1.913l-3.825 1.17a1 1 0 0 1-1.249-.665L.794 3.413a1 1 0 1 1 1.913-.585l.44 1.441C5.555.56 10.332-1.035 14.573.703a9.381 9.381 0 0 1 5.38 5.831 1 1 0 1 1-1.905.608A7.381 7.381 0 0 0 4.86 5.308zm12.327 8.195-1.775.443a1 1 0 1 1-.484-1.94l3.643-.909a.997.997 0 0 1 .61-.08 1 1 0 0 1 .84.75l.968 3.88a1 1 0 0 1-1.94.484l-.33-1.322a9.381 9.381 0 0 1-16.384-1.796l-.26-.634a1 1 0 1 1 1.851-.758l.26.633a7.381 7.381 0 0 0 13.001 1.25z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="label flex flex-col items-start">
                        <span class="label-text-alt">
                            {{ ('Сохраните токен в поле "token" файла "lambda-core.json" на сервере.') }}
                        </span>
                        <span class="label-text-alt">
                            {{ ('Токен хранится в базе данных в зашифрованном виде. Если токен был утрачен, необходимо сгенерировать новый.') }}
                        </span>
                    </div>
                    <InputError :message="form.errors.auth_token"/>
                </div>
            </div>
            <div class="flex justify-end m-4">
                <UpdateButton :disabled="!form.isDirty" />
            </div>
        </form>
    </div>
</template>
