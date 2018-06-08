import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const LOGIN = 'LOGIN'
const LOGIN_SUCCESS = 'LOGIN_SUCCESS'
const LOGOUT = 'LOGOUT'

export default new Vuex.Store({
  user: {
    isLoggedIn: !!localStorage.getItem('api_token')
  },
  mutations: {
    [LOGIN] (state) {
      state.pending = true
    },
    [LOGIN_SUCCESS] (state) {
      state.isLoggedIn = true
      state.pending = false
    },
    [LOGOUT] (state) {
      state.isLoggedIn = false
    }
  },
  actions: {
    login({ commit }, credentials) {
      commit(LOGIN)
    }
  }
})
