<script setup>
import { Head } from "@inertiajs/vue3";
import ToastList from "@/Components/ToastList.vue";
import Navbar from '@/Components/Navbar.vue';
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Footer from '@/Components/Footer.vue';

defineProps({
    title: {
        type: String,
        default: '',
    }
});
</script>

<template>
    <Head :title="$t(title)" />
    <div class="max-w-screen-xl mx-auto h-screen grid grid-rows-layout">
        <ToastList />
        <Navbar/>
        <div>
            <Breadcrumbs/>
            <main class="lg:flex">
                <slot/>
            </main>
        </div>
        <Footer/>
    </div>
</template>
