import Vue from 'vue'
import Vuex from 'vuex'
import { toolbar } from './modules/toolbar'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    toolbar
  },
  strict: process.env.NODE_ENV !== 'production'
})
