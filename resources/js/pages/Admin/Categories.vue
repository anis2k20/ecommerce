<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/CategoryController';
import { destroy } from '@/actions/App/Http/Controllers/CategoryController';
import { update } from '@/actions/App/Http/Controllers/CategoryController';


const showCategoryForm = ref(false);
const showUpdateButton = ref(false);
const selectedCategoryId = ref<number | null>(null);
const form = useForm({
    name: '',
    slug: '',
});

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

function handleFormSubmit() {
    form.post(store.url(), {
        onSuccess: () => {
            showCategoryForm.value = false;
            form.reset();
        },
    });
}

function deleteCategory(id: number) {
    if (confirm('Are you sure you want to delete this category?')) {
        form.delete(destroy.url(id));
    }
}

function updateCategory(id: number) {
    form.patch(update.url(id), {
        onSuccess: () => {
            showCategoryForm.value = false;
            form.reset();
        },
    });
}

function editCategory(category: any) {
    showCategoryForm.value = true;
    form.name = category.name;
    form.slug = category.slug;
    selectedCategoryId.value = category.id;
    showUpdateButton.value = true;
}
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
        <form
            v-if="showCategoryForm"
            @submit.prevent="handleFormSubmit()"
            class="mb-4"
        >
            <input
                type="text"
                v-model="form.name"
                placeholder="Category Name"
                class="mb-2 w-full rounded border p-2"
            />
            <input
                type="text"
                v-model="form.slug"
                placeholder="Category Slug"
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
             <button
                v-if="showUpdateButton"
                @click="updateCategory(selectedCategoryId)"
                class="mb-4 rounded bg-blue-500 px-4 py-2 text-white"
            >
                Update Category
            </button>
        </form>

        <ul class="space-y-2 p-4">
            <li
                class="flex list-outside list-disc items-center justify-between"
                v-for="category in categories"
                :key="category?.id"
            >
                <span>{{ category?.name }}</span>
                <div class="flex items-center gap-2">
                    <button
                        @click="editCategory(category)"
                        class="rounded bg-blue-500 px-2 py-1 text-white"
                    >
                        Edit
                    </button>
                    <button
                        @click="deleteCategory(category?.id)"
                        class="rounded bg-red-500 px-2 py-1 text-white"
                    >
                        Delete
                    </button>
                </div>
            </li>
        </ul>
    </div>
</template>
