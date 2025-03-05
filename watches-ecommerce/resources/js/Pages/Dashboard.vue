<template>
    <AppLayout>
      <!-- The content for this page will be injected into the slot in the AppLayout -->
      <div class="dashboard-content">
        <h1>Welcome to the Dashboard</h1>
        <p>Your dashboard content goes here...</p>
      </div>
    </AppLayout>
  </template>
  
  <script>
  import AppLayout from '../layouts/AppLayout.vue'; // Import the layout
  
  export default {
    components: {
      AppLayout
    }
  };
  </script>
  