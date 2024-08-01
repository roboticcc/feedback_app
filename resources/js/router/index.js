import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Dashboard from '../views/Dashboard.vue';
import FeedbackForm from '../views/FeedbackForm.vue';
import FeedbackList from '../views/FeedbackList.vue';
import FeedbackDetail from '../views/FeedbackDetail.vue';

const routes = [
    { path: '/', name: 'Home', component: Dashboard },
    { path: '/login', name: 'Login', component: Login },
    { path: '/register', name: 'Register', component: Register },
    { path: '/dashboard', name: 'Dashboard', component: Dashboard },
    { path: '/feedback', name: 'FeedbackForm', component: FeedbackForm },
    { path: '/feedback/list', name: 'FeedbackList', component: FeedbackList },
    { path: '/feedback/:id', name: 'FeedbackDetail', component: FeedbackDetail }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
