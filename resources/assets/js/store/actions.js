import Vue from 'vue';
import * as types from './mutation-types';

export const setAuthUser = ({ commit }) => {
  Vue.http.get('/api/user')
    .then(response => {
      if (response.data) {
        commit(types.SET_AUTH_USER, response.data);
      }
    }, () => {
      commit(types.SET_AUTH_USER, {
        id: 0
      });
    });
};

export const setFriends = ({ commit }) => {
  Vue.http.post('/api/friendship/all')
    .then(response => {
      commit(types.SET_FRIENDS, response.data);
    }, () => {});
};