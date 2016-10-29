
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueRouter from 'vue-router'
import Home from './components/Home.vue';

const routes = [
  { path: '/app/', component: Home }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

const app = new Vue({
  router
}).$mount('#app');
