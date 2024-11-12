// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import Contacts from './components/Contacts.vue'; // Assuming you will create this component later
import Interactions from './components/Interactions.vue'; // Assuming you will create this component later
import Sales from './components/Sales.vue'; // Assuming you will create this component later

const routes = [
  { path: '/', component: Dashboard },
  { path: '/contacts', component: Contacts },
  { path: '/interactions', component: Interactions },
  { path: '/sales', component: Sales },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
