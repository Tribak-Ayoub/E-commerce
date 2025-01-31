<template>
  <AuthenticatedLayout>
    <h1>Product List</h1>
    <button @click="showModal" class="btn show-modal-btn">Add Product</button>
    <div>
      <!-- Pass the `show` prop to CreateProduct -->
      <CreateProduct :show="show" @hideModal="hideModal" @productAdded="addNewProduct" />
    </div>
    <div>
      <table>
        <thead>
          <tr>
            <td>ID</td>
            <td>Product Name</td>
            <td>Description</td>
            <td>Price</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td>{{ product.id }}</td>
            <td>{{ product.name }}</td>
            <td>{{ product.description }}</td>
            <td>{{ product.price }}</td>
            <td>
              <button @click="deleteProduct(product.id)">Delete</button>
              <button>Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AuthenticatedLayout>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { ref, onMounted } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import CreateProduct from '@/components/CreateProduct.vue';
  
  const show = ref(false); // Reactive show state
  
  function showModal() {
    show.value = true; // Show modal
  }
  
  function hideModal() {
    show.value = false; // Hide modal
  }
  
  // Fetch data for products
  const products = ref([]);
  const fetchProducts = async () => {
    try {
      const response = await axios.get('/api/products');
      products.value = response.data.data; // Use response.data.data for paginated data
    } catch (error) {
      console.error('Error fetching products:', error);
    }
  };
  
  onMounted(() => {
    fetchProducts(); // Fetch products when the component is mounted
  });
  
  // Add a new product to the list
  function addNewProduct(newProduct) {
    products.value.push(newProduct); // Add the new product to the list
  }
  
  // Delete a product from the list
  const deleteProduct = async (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
      try {
        await axios.delete(`/api/products/${id}`);
        products.value = products.value.filter(product => product.id !== id); // Remove from the local list
        alert('Product deleted successfully!');
      } catch (error) {
        console.error('Error deleting product:', error);
        alert('An error occurred while deleting the product.');
      }
    }
  };
  </script>

  <style scoped>
  .show-modal-btn {
    background-color: #1976d2;
    color: white;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 20px;
    margin-top: 20px;
  }
  
  .show-modal-btn:hover {
    background-color: #1565c0;
  }
  
  /* Styling for the table */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #f9f9f9;
    font-size: 16px;
    text-align: left;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  td,
  th {
    padding: 12px;
    border: 1px solid #ddd;
  }
  
  th {
    background-color: #1976d2;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
  }
  
  td {
    text-align: center;
  }
  
  td button {
    padding: 8px 12px;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin-right: 5px;
  }
  
  td button:nth-child(2) {
    background-color: #4caf50;
    color: white;
  }
  
  td button:nth-child(2):hover {
    background-color: #45a049;
    transform: scale(1.05);
  }
  
  td button:nth-child(1) {
    background-color: #f44336;
    color: white;
  }
  
  td button:nth-child(1):hover {
    background-color: #e53935;
    transform: scale(1.05);
  }
  </style>
  