import * as types from '../mutation-types';

const state = {
  id: null,
  name: '',
  username: '',
  email: ''
};

const mutations = {
  [types.SET_AUTH_USER] (state, user) {
    state.id = user.id;
    state.name = user.name;
    state.username = user.username;
    state.email = user.email;
  }
};

export default {
  state,
  mutations
};