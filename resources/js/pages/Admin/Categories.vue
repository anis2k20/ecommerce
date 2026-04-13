<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const showCategoryForm = ref(false);

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

defineProps({
    categories: Array,
});
</script>

<template>
    <Head title="Categories" />
    <div class="p-4">
        <div class="flex items-center justify-between">
            <h1>All Categories</h1>
            <button
                @click="showCategoryForm = true"
                class="mb-4 rounded bg-blue-500 px-4 py-2 text-white"
            >
                Add Category
            </button>
        </div>
        <form v-if="showCategoryForm" class="mb-4">
            <input
                type="text"
                placeholder="Category Name"
                class="mb-2 w-full rounded border p-2"
            />
            <button
                type="submit"
                class="rounded bg-green-500 px-4 py-2 text-white"
            >
                Add
            </button>
            <button
                @click="showCategoryForm = false"
                type="button"
                class="ml-2 rounded bg-gray-500 px-4 py-2 text-white"
            >
                Cancel
            </button>
        </form>

        <ul>
            <li v-for="category in categories" :key="category?.id">
                {{ category?.name }}
            </li>
        </ul>
    </div>
</template>
