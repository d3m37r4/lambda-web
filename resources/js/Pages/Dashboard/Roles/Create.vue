<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from "vue";
import { selectAll } from '@/Utils/selection';
import InputError from "@/Components/InputError.vue";
import BackButton from "@/Components/BackButton.vue";
import CreateButton from "@/Components/CreateButton.vue";

defineOptions({
    layout: DashboardLayout
});

defineProps({
    title: String,
    permissions: Array
});

const form = useForm({
    name: '',
    permissions: []
});

const selectedPermissions = ref([]);
const isSelectAllChecked = ref();

function selectAllItems(permissions) {
    selectAll(permissions, form.permissions, isSelectAllChecked.value);
    form.permissions = selectedPermissions.value;
}

function store() {
    form.post(route('dashboard.roles.store'));
}
</script>

<template>
    <div class="ml-4 space-y-4">
        <div class="flex items-center space-x-4 mx-4">
            <div class="grow">
                <h1 class="text-xl">{{ title }}</h1>
            </div>
            <div class="flex-none">
                <BackButton :routeBack="route('dashboard.roles.index')" />
            </div>
        </div>
        <form @submit.prevent="store">
            <div class="bg-base-200 rounded-box p-4">
                <div class="grid grid-cols-6 gap-x-6">
                    <div class="col-span-3">
                        <label for="name" class="label">
                            <span class="text-base label-text">{{ ('Имя роли') }}</span>
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.name"
                            required
                            autofocus
                        />
                        <InputError :message="form.errors.name"/>
                    </div>
                </div>
                <div class="mt-2">
                    <label class="label">
                        <span class="text-base label-text">{{ ('Доступные разрешения') }}</span>
                    </label>
                    <div class="flex flex-wrap gap-2 justify-start">
                        <div v-for="permission in permissions" >
                            <label class="label cursor-pointer">
                                <input
                                    type="checkbox"
                                    class="checkbox mr-2"
                                    v-model="form.permissions"
                                    :value="permission.id"
                                />
                                <span class="label-text">{{ permission.name }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex mt-2">
                    <label class="label cursor-pointer">
                        <input
                            type="checkbox"
                            class="checkbox checkbox-primary mr-2"
                            :checked="form.permissions.length === permissions.length"
                            v-model="isSelectAllChecked"
                            @change="selectAllItems(permissions)"
                        />
                        <span class="label-text text-primary">{{ ('Выбрать все доступные разрешения') }}</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-end m-4">
                <CreateButton :disabled="!form.isDirty" />
            </div>
        </form>
    </div>
</template>
