import VueRouter from 'vue-router';
import Vue from 'vue';
import Home from './components/Home.vue';
import Dashboard from './components/Dashboard.vue';

Vue.use(VueRouter);

export default {
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Home
    },
    {
      path: '/dashboard',
      component: Dashboard
    },
  ]
}