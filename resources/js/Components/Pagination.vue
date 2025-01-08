<script setup>
import { Link } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';

const props = defineProps({
    links: Array,
    items: Object,
});

const getLabel = (label) => {
    if (label.includes('Previous')) {
        return trans('pagination.previous');
    }

    if (label.includes('Next')) {
        return trans('pagination.next');
    }

    return label;
};
</script>

<template>
    <div v-if="links.length > 3" class="flex items-center justify-between mx-4">
        <div class="text-sm">
            {{ $t('pagination.items_shown', { from: items.from, to: items.to, total: items.total }) }}
        </div>
        <div class="join">
            <template v-for="(link, index) in links" :key="`link-${index}`">
                <div v-if="link.url === null"
                     class="join-item btn normal-case btn-disabled"
                     v-html="getLabel(link.label)" />
                <Link v-else
                      class="join-item btn normal-case"
                      :class="{ 'btn-active text-orange-500': link.active }"
                      :href="link.url"
                      v-html="getLabel(link.label)" />
            </template>
        </div>
    </div>
</template>
