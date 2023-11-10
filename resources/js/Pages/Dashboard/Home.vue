<template>
    <Head title="Home"/>
    <div class="ml-4">
        <h1>Test</h1>
        <div class="bg-base-200 rounded-box p-4">
            <p>
                text text text text text text text text text text text text text text text
                text text text text text text text text text text text text text text text
                text text text text text text text text text text text text text text text
                text text text text text text text text text text text text text text text
                text text text text text text text text text text text text text text text
            </p>
            <button class="btn btn-secondary">Button</button>
        </div>
    </div>
</template>

<script>
import DashboardLayout from '@/Layouts/Dashboard.vue'
import { Head } from '@inertiajs/vue3'
export default {
    components: {
        Head,
    },
    layout: DashboardLayout,
}
</script>
