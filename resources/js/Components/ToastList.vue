<script setup>
import ToastListItem from "@/Components/ToastListItem.vue";
import { ref, onMounted, onUnmounted, onBeforeUnmount, computed } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/vue3";
import toast from "@/Store/toast";

const page = usePage();
const removeFinishEventListener = Inertia.on('finish', () => {
    if (page.props.toast.status && page.props.toast.message) {
        toast.add({
            status: page.props.toast.status,
            message: page.props.toast.message,
        });
        page.props.toast.status = null;
        page.props.toast.message = null;
    }
});
const hasScrollBar = ref(false);
const indentRight  = computed(() => {
    return hasScrollBar.value ? 'pe-2' : 'pe-4.5';
});
const checkScrollbar = () => {
    hasScrollBar.value = document.body.scrollHeight > window.innerHeight;
};

onMounted(() => {
    checkScrollbar();
    window.addEventListener('resize', checkScrollbar);
});
onUnmounted(() => removeFinishEventListener());
onBeforeUnmount(() => {
    window.removeEventListener('resize', checkScrollbar);
});

const remove = (index) => {
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
        class="toast"
        :class="indentRight">
        <ToastListItem
            v-for="(item, index) in toast.items"
            :key="item.key"
            :status="item.status"
            :message="item.message"
            @remove="remove(index)" />
    </TransitionGroup>
</template>
