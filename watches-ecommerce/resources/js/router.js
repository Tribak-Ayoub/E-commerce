import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        component: () => import('./Pages/HomeRoute.vue'),
        meta: { requiresAuth: true } // Requires authentication
    },
    // {
    //     path: '/products',
    //     component: () => import('./Pages/Products/Index.vue'),
    //     meta: { requiresAuth: true } // Requires authentication
    // },
    // // Add more SPA routes here
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard to check authentication
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('loggedIn') === 'true';

    // Exclude authentication routes from the guard
    const isAuthRoute = ['/login', '/register', '/forgot-password'].includes(to.path);

    if (to.meta.requiresAuth && !isAuthenticated && !isAuthRoute) {
        window.location.href = '/login'; // Redirect to Laravel login page
    } else {
        next();
    }
});

export default router;