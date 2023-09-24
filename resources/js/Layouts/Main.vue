<template>
    <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
        <div class="sticky z-10 top-0 h-16 ">
            <div class="flex items-center justify-between space-x-4 2xl:container">
                     <Navbar />
            </div>
        </div>
        <div class="px-6 pt-6 2xl:container">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <slot />
            </div>
        </div>
        <div>
            <Footer/>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
export default {
    components: {Footer, Navbar}
}
</script>
