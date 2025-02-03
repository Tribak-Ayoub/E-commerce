import { createRouter, createWebHistory } from 'vue-router';

import ProductList from './components/ProductList.vue';
import ExampleComponent from './components/ExampleComponent.vue';

const routes = [
    { path: '/', component: ExampleComponent },
    { path: '/products', component: ProductList}
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;