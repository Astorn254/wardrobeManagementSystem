import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state() {
    return {
      user: null,
      token: localStorage.getItem('token') || '',
    };
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_TOKEN(state, token) {
      state.token = token;
      localStorage.setItem('token', token);
    },
    LOGOUT(state) {
      state.user = null;
      state.token = '';
      localStorage.removeItem('token');
    },
  },
  actions: {
    async login({ commit }, { email, password }) {
      const response = await axios.post('http://localhost:8000/api/login', { email, password });
      commit('SET_TOKEN', response.data.token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
    },
    async logout({ commit }) {
      await axios.post('http://localhost:8000/api/logout');
      commit('LOGOUT');
    },
    async getUser({ commit }) {
      const response = await axios.get('http://localhost:8000/api/user');
      commit('SET_USER', response.data);
    },
  },
});

export default store;
