<script setup>
import { Head } from '@inertiajs/vue3';
import ToastList from "@/Components/ToastList.vue";
import Navbar from '@/Components/Navbar.vue';
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Sidebar from '@/Components/Dashboard/Sidebar.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    title: String,
});

function url() {
    return location.pathname;
}
</script>

<template>
    <Head :title="title" />
    <div class="max-w-screen-xl mx-auto h-screen grid grid-rows-layout">
        <ToastList />
        <Navbar />
        <div>
            <Breadcrumbs />
            <main class="lg:flex">
                <div class="w-1/5">
                    <Sidebar :url="url()" />
                </div>
                <div class="w-4/5">
                    <slot />
                </div>
            </main>
        </div>
        <Footer />
    </div>
</template>
