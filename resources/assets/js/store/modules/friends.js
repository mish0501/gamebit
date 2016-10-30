import * as types from '../mutation-types';

const state = {
  all: []
};

const mutations = {
  [types.SET_FRIENDS] (state, friends) {
    state.all = friends;
  }
};

export default {
  state,
  mutations
};