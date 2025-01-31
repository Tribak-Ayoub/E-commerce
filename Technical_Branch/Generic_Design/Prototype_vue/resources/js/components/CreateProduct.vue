<template>
    <div class="modal-overlay" v-if="show">
      <div class="modal">
        <h2>Add New Product</h2>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" v-model="form.name" required />
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" v-model="form.description" required></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" v-model="form.price" step="0.01" required />
          </div>
          <div class="form-actions">
            <button type="button" @click="closeModal">Cancel</button>
            <button type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, defineProps, defineEmits } from 'vue';
  import axios from 'axios';
  
  // Define the `show` prop
  const props = defineProps({
    show: {
      type: Boolean,
      required: true,
    },
  });
  
  // Define emits
  const emit = defineEmits(['hideModal', 'productAdded']);
  
  const form = ref({
    name: '',
    description: '',
    price: 0,
  });
  
  const submitForm = async () => {
    try {
      const response = await axios.post('/api/products', form.value);
      emit('productAdded', response.data); // Emit the new product to the parent component
      closeModal();
      alert('Product added successfully!');
    } catch (error) {
      console.error('Error adding product:', error);
      alert('Failed to add product. Please try again.');
    }
  };
  
  const closeModal = () => {
    emit('hideModal'); // Emit event to hide the modal
    resetForm(); // Reset the form fields
  };
  
  const resetForm = () => {
    form.value = {
      name: '',
      description: '',
      price: 0,
    };
  };
  </script>
  
  <style scoped>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .modal {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  input,
  textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
  }
  
  textarea {
    resize: vertical;
    height: 100px;
  }
  
  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
  }
  
  button {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }
  
  button[type='submit'] {
    background-color: #1976d2;
    color: white;
  }
  
  button[type='submit']:hover {
    background-color: #1565c0;
  }
  
  button[type='button'] {
    background-color: #f44336;
    color: white;
  }
  
  button[type='button']:hover {
    background-color: #e53935;
  }
  </style>