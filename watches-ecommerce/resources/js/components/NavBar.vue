<template>
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <router-link to="/" class="text-xl font-bold text-gray-800"> MyApp </router-link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <router-link to="/dashboard"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium"
                            :class="{ 'text-gray-900 font-semibold': isActiveRoute('dashboard') }">
                            Dashboard
                        </router-link>
                        <router-link to="/products"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium"
                            :class="{ 'text-gray-900 font-semibold': isActiveRoute('products.index') }">
                            Products
                        </router-link>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div v-if="user" class="relative">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none"
                            @click="openDropdown = !openDropdown">
                            <div>{{ user.name }}</div>
                            <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div v-if="openDropdown" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2">
                            <router-link to="/profile"
                                class="block px-4 py-2 text-sm text-gray-700">Profile</router-link>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" @click.prevent="logout">Log
                                Out</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = !open"
                        class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div v-if="open" class="sm:hidden">
            <router-link to="/dashboard" class="block px-3 py-2 text-gray-700">Dashboard</router-link>
            <router-link to="/products" class="block px-3 py-2 text-gray-700">Products</router-link>
            <router-link to="/profile/edit" class="block px-3 py-2 text-gray-700">Profile</router-link>
            <a href="#" class="block px-3 py-2 text-gray-700" @click.prevent="logout">Log Out</a>
        </div>
    </nav>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const open = ref(false); // For mobile menu
const openDropdown = ref(false); // For user dropdown
const user = ref(null); // User data

// Fetch user details dynamically
const fetchUser = async () => {
    try {
        const response = await axios.get('/user'); // Adjust this endpoint if needed
        user.value = response.data;
    } catch (error) {
        console.error('Error fetching user data:', error);
    }
};

// Logout function
const logout = async () => {
    try {
        await axios.post('/logout'); // Laravel Sanctum logout
        user.value = null;
        router.push('/login');
    } catch (error) {
        console.error('Error during logout:', error);
    }
};

// Check active route
const isActiveRoute = (routeName) => {
    return router.currentRoute.value.name === routeName;
};

// Fetch user on mount
onMounted(fetchUser);
</script>