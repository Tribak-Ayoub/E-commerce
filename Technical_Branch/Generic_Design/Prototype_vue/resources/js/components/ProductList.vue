<template>
    <div>
      <h1>Product List</h1>
      <ul>
        <li v-for="product in products" :key="product.id">
          {{ product.name }} - {{ product.price }}
          <button @click="deleteProduct(product.id)">Delete</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        products: [],
      };
    },
    mounted() {
      this.fetchProducts();
    },
    methods: {
      fetchProducts() {
        axios.get('/products').then(response => {
          this.products = response.data;
        });
      },
      deleteProduct(id) {
        axios.delete(`/products/${id}`).then(() => {
          this.fetchProducts();
        });
      },
    },
  };
  </script>