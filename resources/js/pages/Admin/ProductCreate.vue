<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
defineProps({
    categories: Array,
});

const form = useForm({
    name: '',
    slug: '',
    price: '',
    category_id: '',
    description: '',
    image: null,
});

function handleFormSubmit() {
    console.log(form);
    form.post('/admin/products', {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            imagePreview.value = null;
        },
    });
}

const imagePreview = ref(null);

function handleImageChange(event) {
    const file = event.target.files[0];
    form.image = file;

    if (file) {
        imagePreview.value = URL.createObjectURL(file);
    }
}
</script>

<template>
    <div class="p-10">
        <h2 class="py-2 font-bold">Product Create</h2>
        <form
            @submit.prevent="handleFormSubmit"
            class="grid grid-cols-3 items-center gap-2"
        >
            <input type="text" v-model="form.name" placeholder="Product Name" />
            <input type="text" v-model="form.slug" placeholder="Product Slug" />
            <input
                type="number"
                v-model="form.price"
                placeholder="Product Price"
            />
            <input
                type="text"
                v-model="form.description"
                placeholder="Product Description"
            />
            <select v-model="form.category_id">
                <option value="">Select Category</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
            <input
                type="file"
                @change="handleImageChange"
                placeholder="Product Image"
                accept="image/*"
            />
            <img v-if="imagePreview" :src="imagePreview" class="w-20 h-20 rounded"/>
            <button type="submit">Create Product</button>
        </form>
    </div>
</template>
<style scoped>
input {
    padding: 0.5rem;

    border: 1px solid #ccc;
    border-radius: 10px;
}
select {
    padding: 0.5rem;

    border: 1px solid #ccc;
    border-radius: 10px;
}
button {
    padding: 0.5rem 1rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
</style>
