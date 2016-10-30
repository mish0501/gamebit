
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
import VueRouter from 'vue-router';
import store from './store';
import App from './components/App.vue';
import AllGames from './components/AllGames.vue';
import Friend from './components/Friend.vue';
import AddFriend from './components/AddFriend.vue';
import Notifications from './components/Notifications.vue';
import Game from './components/Game.vue';
import Room from './components/Room.vue';
import JoinGame from './components/JoinGame.vue';

Vue.component('notifications', Notifications);
Vue.component('join-game', JoinGame);

const routes = [
  {
    path: '/app',
    component: App,
    children: [
      {
        path: 'friend',
        component: Friend,
        name: 'friends',
        children: [
          { path: 'add', component: AddFriend, name: 'addFriend' }
        ]
      },
      {
        path: 'game',
        component: AllGames,
        name: 'games'
      },
      { path: 'game/:id', component: Game, name: 'game' },
      { path: 'room/:code', component: Room, name: 'room' }
    ]
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

const app = new Vue({
  router,
  store
}).$mount('#app');
