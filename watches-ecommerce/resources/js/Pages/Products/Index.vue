<template>
    <div class="container mx-auto px-4 py-8">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-6">Products</h1>

        <!-- Create Product Button -->
        <div class="mb-6">
            <router-link to="/products/create"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                Create New Product
            </router-link>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="text-center text-gray-600">
            Loading products...
        </div>

        <!-- Error State -->
        <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md mb-6">
            {{ error }}
        </div>

        <!-- Products Table -->
        <div v-if="!loading && !error">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="product in products" :key="product.id" class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ product.name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ product.description }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            ${{ product.price }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-900">

                            <!-- Delete Button -->
                            <button @click="deleteProduct(product.id)" class="text-red-500 hover:text-red-700">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Empty State -->
            <div v-if="products.length === 0" class="text-center text-gray-600 mt-6">
                No products found.
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

// State
const products = ref([]);
const loading = ref(true);
const error = ref(null);

// Fetch Products
const fetchProducts = async () => {
    try {
        const response = await axios.get('http://127.0.0.1:8000/products');
        console.log(response.data);
        products.value = response.data;
    } catch (err) {
        error.value = 'Failed to fetch products. Please try again later.';
        console.error('Error fetching products:', err);
    } finally {
        loading.value = false;
    }
};

// Delete Product
const deleteProduct = async (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        try {
            await axios.delete(`/products/${id}`); // Updated endpoint
            products.value = products.value.filter(product => product.id !== id);
        } catch (err) {
            error.value = 'Failed to delete product. Please try again later.';
            console.error('Error deleting product:', err);
        }
    }
};

// Fetch products on component mount
onMounted(() => {
    fetchProducts();
});
</script>

<style scoped>
/* Add custom styles here if needed */
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