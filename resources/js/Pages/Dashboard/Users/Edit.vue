<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import BackButton from "@/Components/BackButton.vue";
import UpdateButton from "@/Components/UpdateButton.vue";
import InputError from "@/Components/InputError.vue";

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
    role: props.user.role.id,
    permissions: props.user.permissions,
});

const selectedPermissions = ref([]);

// Синхронизация выбранных разрешений с разрешениями текущей роли
watch(() => form.role, (newRole) => {
    const role = props.roles.find(role => role.id === newRole);
    if (role && role.permissions) {
        selectedPermissions.value = role.permissions.map(permission => permission.id);
    } else {
        selectedPermissions.value = [];
    }
});

// Переключение флажка "Выбрать все"
const isSelectAllChecked = computed(() => {
    return selectedPermissions.value.length === props.permissions.length;
});

function selectAllItems() {
    if (isSelectAllChecked.value) {
        selectedPermissions.value = props.permissions.map(permission => permission.id);
    } else {
        selectedPermissions.value = [];
    }
}

watch(isSelectAllChecked, selectAllItems);

const isFormModified = computed(() => {
    return form.isDirty;
});

function update() {
    form.permissions = selectedPermissions.value;
    form.put(route('dashboard.users.update', props.user));
}
</script>

<template>
    <div class="ml-4 space-y-4">
        <div class="flex items-center space-x-4 mx-4">
            <div class="grow">
                <h1 class="text-xl">{{ title }}</h1>
            </div>
            <div class="flex-none">
                <BackButton :routeBack="route('dashboard.users.index')" />
            </div>
        </div>
        <form @submit.prevent="update">
            <div class="bg-base-200 rounded-box p-4">
                <h2 class="text-lg">{{ ('Основная информация') }}</h2>
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
                            autofocus />
                        <InputError :message="form.errors.login"/>
                    </div>
                    <div class="col-span-3">
                        <label for="email" class="label">
                            <span class="text-base label-text">{{ ('Эл. почта') }}</span>
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.email"
                            required />
                        <InputError :message="form.errors.email"/>
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
                            v-model="form.password" />
                        <InputError :message="form.errors.password"/>
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
                            required>
                            <option disabled>{{ ('Назначьте роль пользователю...') }}</option>
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </select>
                        <InputError :message="form.errors.role"/>
                    </div>
                </div>
            </div>
            <div class="bg-base-200 rounded-box my-4 p-4">
                <h2 class="text-lg">{{ ('Доступные разрешения') }}</h2>
                <div class="flex flex-wrap gap-2 justify-start">
                    <div v-for="permission in permissions" :key="permission.id">
                        <label class="label cursor-pointer">
                            <input
                                type="checkbox"
                                class="checkbox mr-2"
                                v-model="selectedPermissions"
                                :id="`permission_${permission.id}`"
                                :value="permission.id" />
                            <span class="label-text">{{ permission.name }}</span>
                        </label>
                    </div>
                </div>
                <div class="flex mt-2">
                    <label class="label cursor-pointer">
                        <input
                            type="checkbox"
                            class="checkbox checkbox-primary mr-2"
                            v-model="isSelectAllChecked" />
                        <span class="label-text text-primary">{{ ('Выбрать все доступные разрешения') }}</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-end m-4">
                <UpdateButton :disabled="!isFormModified" />
            </div>
        </form>
    </div>
</template>
