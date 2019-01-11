import Vue from 'vue'
import Vuex from 'vuex'
import { utilitybar } from './modules/utilitybar'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    utilitybar,
  },

  strict: process.env.NODE_ENV !== 'production'
})
