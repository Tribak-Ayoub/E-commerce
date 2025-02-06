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
                this.user = response.data.user;
                this.token = response.data.token;
            } catch (error) {
                throw error;
            }
        },
        async logout() {
            try {
                await axios.post('/logout');
                this.user = null;
                this.token = null;
            } catch (error) {
                throw error;
            }
        },
    },
});
