<script setup>
import DashboardLayout from '@/Layouts/Dashboard.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import BackButton from "@/Components/Buttons/BackButton.vue";
import CreateButton from "@/Components/Buttons/CreateButton.vue";

defineOptions({
    layout: DashboardLayout
});

const props = defineProps({
    title: String,
    gameServer: Object,
});

const form = useForm({
    name: '',
    months: 0,
    days: 0,
    hours: 0,
    minutes: 0,
});

const store = () => {
    form.post(route('dashboard.game-servers.punishment-reasons.store', props.gameServer));
}
</script>

<template>
    <div class="ml-4 space-y-4">
        <div class="flex items-center space-x-4 mx-4">
            <div class="grow">
                <h1 class="text-xl">{{ title }}</h1>
            </div>
            <div class="flex-none">
                <BackButton title="Назад" :href="route('dashboard.game-servers.show', props.gameServer)" />
            </div>
        </div>
        <form @submit.prevent="store">
            <div class="bg-base-200 rounded-box p-4">
                <div class="grid grid-cols-6 gap-x-6">
                    <div class="col-span-3">
                        <label for="name" class="label">
                            <span class="text-base label-text">{{ ('Название причины') }}</span>
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                            v-model="form.name"
                            required
                            autofocus />
                        <InputError :message="form.errors.name" />
                    </div>
                </div>
                <div class="mt-2">
                    <label class="label">
                        <span class="text-base label-text">{{ ('Длительность наказания') }}</span>
                    </label>
                    <div class="grid grid-cols-6 gap-x-6">
                        <div>
                            <label for="months" class="label">
                                <span class="label-text">{{ ('Месяцы') }}</span>
                            </label>
                            <input
                                id="months"
                                name="months"
                                type="number"
                                class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                                v-model.number="form.months"
                                min="0" />
                            <InputError :message="form.errors.months" />
                        </div>
                        <div>
                            <label for="days" class="label">
                                <span class="label-text">{{ ('Дни') }}</span>
                            </label>
                            <input
                                id="days"
                                name="days"
                                type="number"
                                class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                                v-model.number="form.days"
                                min="0" />
                            <InputError :message="form.errors.days" />
                        </div>
                        <div>
                            <label for="hours" class="label">
                                <span class="label-text">{{ ('Часы') }}</span>
                            </label>
                            <input
                                id="hours"
                                name="hours"
                                type="number"
                                class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                                v-model.number="form.hours"
                                min="0" />
                            <InputError :message="form.errors.hours" />
                        </div>
                        <div>
                            <label for="minutes" class="label">
                                <span class="label-text">{{ ('Минуты') }}</span>
                            </label>
                            <input
                                id="minutes"
                                name="minutes"
                                type="number"
                                class="input input-bordered w-full focus:ring-1 focus:ring-offset-2 focus:ring-offset-base-200 focus:ring-orange-500"
                                v-model.number="form.minutes"
                                min="0" />
                            <InputError :message="form.errors.minutes" />
                        </div>
                    </div>
                    <div class="flex mt-2">
                        <span class="label-text">
                            {{ ('Оставьте все значения равными нулю для указания бессрочного действия наказания.') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end m-4">
                <CreateButton title="Добавить" :disabled="!form.isDirty" />
            </div>
        </form>
    </div>
</template>
