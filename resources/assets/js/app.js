
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
import App from './components/App.vue';
import Home from './components/Home.vue';
import Friend from './components/Friend.vue';
import AddFriend from './components/AddFriend.vue';
import FriendRequests from './components/FriendRequests.vue';
import Game from './components/Game.vue';

Vue.component('friend-requests', FriendRequests);

const routes = [
  {
    path: '/app',
    component: App,
    children: [
      { path: '', component: Home, name: 'home' },
      {
        path: 'friend',
        component: Friend,
        name: 'friends',
        children: [
          { path: 'add', component: AddFriend, name: 'addFriend' }
        ]
      },
      {
        path: 'game/:id',
        component: Game,
        name: 'game'
      }
    ]
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

const app = new Vue({
  router
}).$mount('#app');
