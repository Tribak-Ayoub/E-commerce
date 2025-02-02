import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    { 
        path: '/', 
        name: 'home', 
        component: () => import('./Pages/Home.vue') 
    },
    { 
        path: '/dashboard', 
        name: 'dashboard', 
        component: () => import('./Pages/Dashboard.vue') 
    },
    { 
        path: '/login', 
        name: 'login', 
        component: () => import('./Pages/Auth/Login.vue') 
    },
    { 
        path: '/register', 
        name: 'register', 
        component: () => import('./Pages/Auth/Register.vue') 
    },
    { 
        path: '/profile', 
        name: 'profile.edit', 
        component: () => import('./Pages/Profile/Edit.vue') 
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;