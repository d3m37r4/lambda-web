<template>
    <div class="max-w-screen-xl mx-auto h-screen grid grid-rows-layout">
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

<script>
import Navbar from '@/Components/Navbar.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Footer from '@/Components/Footer.vue';
export default {
    components: { Navbar, Breadcrumbs, Footer }
}
</script>
