import Vue from 'vue'
import Vuex from 'vuex'
import { breadcrumbs } from './modules/breadcrumbs'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    breadcrumbs,
  },
  strict: process.env.NODE_ENV !== 'production'
})
