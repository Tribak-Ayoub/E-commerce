import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    { path: '/', component: () => import('./Pages/Home.vue') },
    { path: '/dashboard', component: () => import('./Pages/Dashboard.vue') },
    { path: '/login', component: () => import('./Pages/Auth/Login.vue') },
    { path: '/register', component: () => import('./Pages/Auth/Register.vue') },
    { path: '/profile', component: () => import('./Pages/Profile/Edit.vue') },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
