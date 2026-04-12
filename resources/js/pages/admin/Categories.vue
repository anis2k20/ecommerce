<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Categories',
                href: 'admin/categories',
            },
        ],
    },
});
</script>

<template>
    <Head title="Categories"/>
    <div>
        <h1>Categories</h1>
    </div>
</template>
