<template>
    <div v-if="links.length > 3" class="flex items-center justify-between px-4 py-3 sm:px-6">
        <!--        <div class="flex flex-1 justify-between sm:hidden">-->
        <!--            <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>-->
        <!--            <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>-->
        <!--        </div>-->
        <div>
            <!--                <p class="text-sm">-->
            <!--                    Showing-->
            <!--                    <span class="font-medium">1</span>-->
            <!--                    to-->
            <!--                    <span class="font-medium">10</span>-->
            <!--                    of-->
            <!--                    <span class="font-medium">97</span>-->
            <!--                    results-->
            <!--                </p>-->
        </div>
        <div class="join">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" :key="key" class="join-item btn normal-case btn-disabled" v-html="link.label" />
                <Link v-else :key="`link-${key}`" class="join-item btn normal-case" :class="{ 'btn-active text-orange-500': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';

    defineProps({
        links: Array,
    })
</script>
