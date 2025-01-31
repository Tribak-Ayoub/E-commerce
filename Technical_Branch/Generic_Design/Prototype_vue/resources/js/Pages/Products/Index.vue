<template>
    <div>
      <h1>Product List</h1>
  
      <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
      </div>
  
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.name }}</td>
            <td>{{ product.description }}</td>
            <td>{{ product.price }}</td>
            <td>
              <!-- Actions (e.g., edit, delete, restore) -->
              <button @click="deleteProduct(product.id)">Delete</button>
              <button v-if="product.deleted_at" @click="restoreProduct(product.id)">Restore</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      products: Array,
      successMessage: String,
    },
    methods: {
      deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
          axios
            .delete(`/products/${productId}`)
            .then(() => this.$inertia.reload())
            .catch((error) => console.error(error));
        }
      },
      restoreProduct(productId) {
        axios
          .post(`/products/${productId}/restore`)
          .then(() => this.$inertia.reload())
          .catch((error) => console.error(error));
      },
    },
  };
  </script>
  