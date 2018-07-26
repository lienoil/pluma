import Vue from 'vue'
import Vuex from 'vuex'
import { coverimage } from './modules/coverimage'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    coverimage
  },
  strict: process.env.NODE_ENV !== 'production'
})
