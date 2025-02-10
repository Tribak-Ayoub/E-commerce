<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <!-- Page Title -->
            <h1 class="text-3xl font-bold mb-6">Products</h1>

            <!-- Create Product Button -->
            <div class="mb-6">
                <button @click="openCreateModal" class="bg-blue-500 text-black px-4 py-2 rounded">Create
                    Product</button>
            </div>

            <!-- Product List -->
            <div v-if="!loading && !error">
                <table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id">
                            <td class="px-6 py-4">{{ product.name }}</td>
                            <td class="px-6 py-4">{{ product.description }}</td>
                            <td class="px-6 py-4">${{ product.price }}</td>
                            <td class="px-6 py-4">
                                <button @click="deleteProduct(product.id)" class="text-red-700">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div v-if="products.length === 0" class="text-center text-gray-600 mt-6">No products found.</div>

            <!-- Create Product Modal -->
            <CreateProductModal :isOpen="isModalOpen" @close="closeCreateModal" @productAdded="addProduct" />
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AppLayout from '../../layouts/AppLayout.vue';
import CreateProductModal from './create.vue';

// State
const products = ref([]);
const loading = ref(true);
const error = ref(null);
const isModalOpen = ref(false);

// Fetch Products
const fetchProducts = async () => {
    try {
        const response = await axios.get('/products');
        products.value = response.data.data ?? response.data;
    } catch (err) {
        error.value = 'Failed to fetch products.';
        console.error('Error fetching products:', err);
    } finally {
        loading.value = false;
    }
};

// Delete Product
const deleteProduct = async (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        try {
            await axios.delete(`/products/${id}`);
            products.value = products.value.filter(product => product.id !== id);
        } catch (err) {
            error.value = 'Failed to delete product.';
            console.error('Error deleting product:', err);
        }
    }
};

// Modal Handlers
const openCreateModal = () => isModalOpen.value = true;
const closeCreateModal = () => isModalOpen.value = false;

// Add New Product to List
const addProduct = (newProduct) => {
    products.value.push(newProduct);
};

// Fetch products on mount
onMounted(fetchProducts);
</script>

<style scoped>
.container {
    max-width: 1200px;
}

table {
    border-collapse: separate;
    border-spacing: 0;
}

th,
td {
    padding: 12px 16px;
}

th {
    background-color: #f9fafb;
}

tr:hover {
    background-color: #f3f4f6;
}
</style>