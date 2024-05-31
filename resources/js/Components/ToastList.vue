<script setup>
import ToastListItem from "@/Components/ToastListItem.vue";
import { onUnmounted } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/vue3";
import toast from "@/Store/toast";

const page = usePage();

let removeFinishEventListener = Inertia.on('finish', () => {
    if (page.props.toast.status && page.props.toast.message) {
        toast.add({
            status: page.props.toast.status,
            message: page.props.toast.message,
        });
    }
});

onUnmounted(() => removeFinishEventListener());

function remove(index) {
    toast.remove(index);
}
</script>

<template>
    <TransitionGroup
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="max-w-[310px] w-full top-0 right-0 space-y-4 py-4 ps-4 pe-8 fixed z-20">
        <ToastListItem
            v-for="(item, index) in toast.items"
            :key="item.key"
            :status="item.status"
            :message="item.message"
            @remove="remove(index)"
        />
    </TransitionGroup>
</template>
