<template>
    <div class="product-list">
        <h1 class="title">Product List</h1>
        <ul class="product-items">
            <li v-for="product in products" :key="product.id" class="product-item">
                <h2 class="product-name">{{ product.name }}</h2>
                <p class="product-description">{{ product.description }}</p>
                <p class="product-price">Price: ${{ product.price }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const products = ref([]);

        onMounted(async () => {
            try {
                const response = await axios.get('http://127.0.0.1:8000/products');
                products.value = response.data;
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        });

        return { products };
    }
};
</script>

<style scoped>
.product-list {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.title {
    text-align: center;
    color: #333;
    font-size: 2em;
    margin-bottom: 20px;
}

.product-items {
    list-style-type: none;
    padding: 0;
}

.product-item {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.product-name {
    font-size: 1.5em;
    margin: 0;
    color: #333;
}

.product-description {
    color: #555;
    margin: 10px 0;
    font-size: 1.1em;
}

.product-price {
    color: #007bff;
    font-weight: bold;
    font-size: 1.2em;
}
</style>
