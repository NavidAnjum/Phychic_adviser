// router.js
import { createRouter, createWebHistory } from 'vue-router';
import Login from './Auth/Login.vue';
import Register from './Auth/Register.vue';
import SellerDashboard from './seller/dashboard.vue';
import UserDashboard from './user/dashboard.vue';

const routes = [
    // ... other routes
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/dashboard', component: UserDashboard },
    { path: '/seller/dashboard', component: SellerDashboard },

];

const router = createRouter({
    history: createWebHistory('/'),
    routes,
});

export default router;
