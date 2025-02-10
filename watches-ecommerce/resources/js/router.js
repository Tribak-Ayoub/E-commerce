import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        component: () => import('./Pages/HomeRoute.vue'),
        meta: { requiresAuth: true } // Requires authentication
    },
    {
        path: '/dashboard',
        component: () => import('./Pages/Dashboard.vue'),
    },
    {
        path: '/products',
        component: () => import('./Pages/Products/Index.vue'),
        meta: { requiresAuth: true } // Requires authentication
    },
    {
        path: '/login', // Redirects to Laravel's Blade login
        beforeEnter() {
            window.location.href = "/login"; // Blade Login Page
        }
    },
    {
        path: '/register', // Redirects to Laravel's Blade register
        beforeEnter() {
            window.location.href = "/register"; // Blade Register Page
        }
    },
    {
        path: '/profile/edit', // Redirects to Laravel's Blade profile edit
        beforeEnter() {
            window.location.href = "/profile"; // Blade Profile Page
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard to check authentication
// router.beforeEach((to, from, next) => {
//     const isAuthenticated = localStorage.getItem('loggedIn') === 'true';

//     // Exclude authentication routes from the guard
//     const isAuthRoute = ['/login', '/register', '/forgot-password'].includes(to.path);

//     if (to.meta.requiresAuth && !isAuthenticated && !isAuthRoute) {
//         window.location.href = '/login'; // Redirect to Laravel login page
//     } else {
//         next();
//     }
// });

export default router;