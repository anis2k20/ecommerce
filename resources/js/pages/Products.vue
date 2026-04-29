<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    products: {
        type: Object,
        required: true,
    },
});

const addToCart = (product) => {
    alert(`Added ${product.name} to cart`);
    // TODO: Implement cart functionality
};

const addToWishlist = (product) => {
    alert(`Added ${product.name} to wishlist`);
    // TODO: Implement wishlist functionality
};
</script>

<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Products</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div v-for="product in products.data" :key="product.id" class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img v-if="product.image_url" :src="product.image_url" :alt="product.name" class="w-full h-48 object-cover">
                <div v-else class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
                <div class="p-4">
                    <h2 class="text-xl text-gray-600 font-semibold mb-2">{{ product.name }}</h2>
                    <p class="text-gray-600 mb-2">{{ product.category.name }}</p>
                    <p class="text-2xl font-bold text-green-600">${{ product.price }}</p>
                    <p v-if="product.description" class="text-sm text-gray-500 mt-2">{{ product.description.length > 100 ? product.description.substring(0, 100) + '...' : product.description }}</p>
                    <div class="flex justify-between gap-2 mt-4">
                        <button @click="addToCart(product)" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors duration-200 flex-1">Add to Cart</button>
                        <button @click="addToWishlist(product)" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition-colors duration-200 flex-1">Add to Wishlist</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-8 flex justify-center flex-wrap gap-2">
            <template v-for="link in products.links" :key="link.label">
                <Link v-if="link.url" :href="link.url" :class="link.active ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'" class="px-4 py-2 rounded-md transition-colors duration-200" v-html="link.label"></Link>
                <span v-else :class="'bg-gray-200 text-gray-400 cursor-not-allowed px-4 py-2 rounded-md'" v-html="link.label"></span>
            </template>
        </div>
    </div>
</template>
