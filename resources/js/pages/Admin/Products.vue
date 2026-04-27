<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    products: Array,
});
</script>
<template>
    <div class="p-10">
        <div class="mt-2 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Products</h1>
            <Link
                href="/admin/products/create"
                class="btn btn-primary mb-3 border p-2"
                >+ Add Product</Link
            >
        </div>
        <ul class="grid grid-cols-4 gap-4">
            <li
                v-for="product in products?.data"
                :key="product?.id"
                class="mb-2 border p-4 flex justify-between items-start rounded"
            >
                <div>
                    <h2>{{ product?.name }}</h2>
                    <p>{{ product?.description }}</p>
                    <p>Price: {{ product?.price }} Tk</p>
                </div>
                <img :src="product?.image_url" alt="Product Image" class="w-20 h-20 rounded" />
            </li>
        </ul>
    </div>
</template>
