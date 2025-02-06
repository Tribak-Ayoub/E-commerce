import { createRouter, createWebHistory } from 'vue-router';
import Home from './Pages/Home.vue';
import Login from './Pages/Auth/Login.vue';
import Register from './Pages/Auth/Register.vue';
import Dashboard from './Pages/Dashboard.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Navigation Guard (to protect routes)
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('token'); // Check token
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login'); // Redirect to login if not authenticated
    } else {
        next();
    }
});

export default router;
