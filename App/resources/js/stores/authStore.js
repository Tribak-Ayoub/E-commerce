// stores/authStore.js
import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: null,
    }),

    actions: {
        async login({ email, password, remember }) {
            try {
                const response = await axios.post('/login', { email, password, remember });
                console.log("Login API response:", response.data);  // ✅ Debugging
        
                this.user = response.data.user;
                this.token = response.data.token;
        
                console.log("User stored in Pinia:", this.user);  // ✅ Check if state updates
                console.log("Token stored in Pinia:", this.token);  // ✅ Check token
        
                // Optionally save token in localStorage to persist between sessions
                localStorage.setItem('token', this.token);
        
            } catch (error) {
                console.error("Login failed:", error.response?.data || error.message);
                throw error;
            }
        },        
        logout() {
            this.user = null;
            this.token = null;
            localStorage.removeItem('token'); // Clear token from localStorage
        }
    }
    
});
