<template>
    <AppLayout>
        <h2>HOME</h2>
        <router-link to="/products">products </router-link>
    </AppLayout>
</template>

<script>
// import axios from "axios";
// import { ref } from "vue";

// const response = ref();

// const triggerEndpoint = async () => {
//     try {
//         response.value = await axios.get("/api/test-me");
//     } catch (error) {
//         console.error(error);
//     }
// };

import AppLayout from '../layouts/AppLayout.vue'; // Import the layout

export default {
    components: {
        AppLayout
    }
};
</script>
