<template>
    <div>
      <NavBar />  <!-- Include the NavBar component -->
      <main>
        <slot></slot> <!-- Content from the page will be rendered here -->
      </main>
    </div>
  </template>
  
  <script>
  import NavBar from '../components/NavBar.vue'; // Import the NavBar component
  
  export default {
    components: {
      NavBar
    }
  };
  </script>
  