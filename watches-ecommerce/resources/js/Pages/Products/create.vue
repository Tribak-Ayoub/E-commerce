<template>
    <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-md w-96">
            <h2 class="text-xl font-bold mb-4">Create Product</h2>

            <input v-model="form.name" type="text" placeholder="Name" class="w-full border p-2 mb-2 rounded" />
            <input v-model="form.description" type="text" placeholder="Description"
                class="w-full border p-2 mb-2 rounded" />
            <input v-model="form.price" type="number" placeholder="Price" class="w-full border p-2 mb-2 rounded" />

            <div class="flex justify-end space-x-2 mt-4">
                <button @click="closeModal" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                <button @click="createProduct" class="bg-blue-500 text-black px-4 py-2 rounded">Create</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

// Props and emits
defineProps(['isOpen']);
const emit = defineEmits(['close', 'productAdded']);

const form = ref({ name: '', description: '', price: '' });

// Close modal
const closeModal = () => {
    emit('close');
};

// Create product
const createProduct = async () => {
    try {
        const response = await axios.post('/products', form.value);
        emit('productAdded', response.data);
        closeModal();
    } catch (error) {
        console.error('Error creating product:', error);
    }
};

</script>