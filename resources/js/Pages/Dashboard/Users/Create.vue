<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';
import BackButton from "@/Components/BackButton.vue";
import CreateButton from "@/Components/CreateButton.vue";
import InputError from "@/Components/InputError.vue";

defineOptions({
    layout: DashboardLayout
});

const props = defineProps({
    title: String,
    roles: Array,
    permissions: Array,
    genders: Array,
    countries: Array
});

const form = useForm({
    login: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
    permissions: [],
    gender: '',
    name:'',
    // country: '',
    // birth_date: '',
});

const isSelectAllChecked = ref(false);
const filteredPermissions = computed(() => {
    const role = props.roles.find(role => role.id === form.role);
    return role ? role.permissions.sort((a, b) => a.id - b.id) : [];
});
const availablePermissions = computed(() => {
    const rolePermissions = filteredPermissions.value.map(p => p.id);
    return props.permissions.filter(permission => !rolePermissions.includes(permission.id));
});

const selectAllPermissions = () => {
    form.permissions = isSelectAllChecked.value ? props.permissions.map(permission => permission.id) : [];
};

watch(() => form.role, (newRole) => {
    const role = props.roles.find(role => role.id === newRole);
    form.permissions = role ? role.permissions.map(permission => permission.id) : [];
});

watch(() => form.permissions, () => {
    isSelectAllChecked.value = form.permissions.length === props.permissions.length;
});

watch(isSelectAllChecked, () => {
    selectAllPermissions();
});

const store = () => {
    form.post(route('dashboard.users.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}
</script>

<template>
    <div class="ml-4 space-y-4">
        <div class="flex items-center justify-between mx-4">
            <h1 class="text-xl">{{ title }}</h1>
            <BackButton :routeBack="route('dashboard.users.index')" />
        </div>
        <form @submit.prevent="store">
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
                            autofocus
                            autocomplete="login" />
                        <InputError :message="form.errors.login" />
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
                            autocomplete="email" />
                        <InputError :message="form.errors.email" />
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
                            autocomplete="password" />
                        <InputError :message="form.errors.password" />
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
                            autocomplete="password" />
                        <InputError :message="form.errors.password_confirmation" />
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
                            v-model="form.role">
                            <option disabled value="">{{ ('Назначьте роль пользователю') }}</option>
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                        </select>
                        <InputError :message="form.errors.role" />
                    </div>
                </div>
                <TransitionGroup
                    v-show="form.role !== ''"
                    tag="div"
                    enter-from-class="opacity-0"
                    enter-active-class="duration-500"
                    leave-active-class="duration-500"
                    leave-to-class="opacity-0">
                    <div class="label">
                        <span class="text-base label-text">{{ ('Разрешения для выбранной роли') }}</span>
                    </div>
                    <div v-if="filteredPermissions.length > 0" class="flex flex-wrap justify-start gap-2">
                        <div v-for="permission in filteredPermissions" :key="permission.id">
                            <span class="badge badge-primary rounded me-1">{{ permission.name }}</span>
                        </div>
                    </div>
                    <div v-else>
                        <!--TODO: Create an alert component-->
                        <div class="alert alert-warning">
                            <svg class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            <span>{{ 'Для данной роли разрешения не определены.' }}</span>
                        </div>
                    </div>
                </TransitionGroup>
            </div>
            <div v-if="availablePermissions.length > 0" class="bg-base-200 rounded-box my-4 p-4">
                <h2 class="text-lg">{{ ('Дополнительные разрешения') }}</h2>
                <p class="text-sm my-2">{{ 'Вы можете назначить пользователю дополнительные разрешения, которые будут действовать независимо от выбранной роли.' }}</p>
                <div class="flex flex-wrap gap-x-2">
                    <div v-for="permission in availablePermissions" :key="permission.id">
                        <label class="label cursor-pointer">
                            <input
                                type="checkbox"
                                class="checkbox mr-2"
                                v-model="form.permissions"
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
            <div class="bg-base-200 rounded-box my-4 p-4">
                <h2 class="text-lg">{{ ('Дополнительная информация') }}</h2>
                <div class="grid grid-cols-6 gap-x-6">
                    <div class="col-span-3">
                        <label for="name" class="label">
                            <span class="text-base label-text">{{ ('Имя') }}</span>
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="col-span-3">
                        <label for="gender" class="label">
                            <span class="text-base label-text">{{ ('Пол') }}</span>
                        </label>
                        <select
                            id="gender"
                            name="gender"
                            class="select select-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.gender">
                            <option disabled value="">{{ ('Укажите пол пользователя') }}</option>
                            <option v-for="gender in genders" :value="gender.id">{{ gender.name }}</option>
                        </select>
                        <InputError :message="form.errors.gender" />
                    </div>
                </div>
                <!--                Maybe this will be added                -->
<!--                <div class="grid grid-cols-6 gap-x-6">-->
<!--                    <div class="col-span-3">-->
<!--                        <label for="birth_date" class="label">-->
<!--                            <span class="text-base label-text">{{ ('Дата рождения') }}</span>-->
<!--                        </label>-->
<!--                        <input-->
<!--                            id="birth_date"-->
<!--                            name="birth_date"-->
<!--                            type="text"-->
<!--                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"-->
<!--                            v-model="form.birth_date" />-->
<!--                        <InputError :message="form.errors.birth_date" />-->
<!--                    </div>-->
<!--                    <div class="col-span-3">-->
<!--                        <label for="country" class="label">-->
<!--                            <span class="text-base label-text">{{ ('Страна') }}</span>-->
<!--                        </label>-->
<!--                        <select-->
<!--                            id="country"-->
<!--                            name="country"-->
<!--                            class="select select-text select-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"-->
<!--                            v-model="form.country">-->
<!--                            <option disabled value="">{{ ('Укажите страну пользователя') }}</option>-->
<!--                            <option v-for="country in countries" :value="country.id">{{ country.name }}</option>-->
<!--                        </select>-->
<!--                        <InputError :message="form.errors.country" />-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="grid gap-x-6">-->
<!--                    <label class="form-control">-->
<!--                        <label for="biography" class="label">-->
<!--                            <span class="text-base label-text">{{ ('О себе') }}</span>-->
<!--                        </label>-->
<!--                        <textarea class="textarea textarea-bordered" placeholder="Bio"></textarea>-->
<!--                    </label>-->
<!--                </div>-->
                <!--                Maybe this will be added                -->
            </div>
            <div class="flex justify-end m-4">
                <CreateButton :disabled="!form.isDirty" />
            </div>
        </form>
    </div>
</template>
