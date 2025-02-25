import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Clothing from '../views/Clothing.vue';

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/clothes',
    name: 'clothes',
    component: Clothing,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
