import Vue from 'vue'
import Vuex from 'vuex'
import { datatable } from './modules/datatable'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    datatable
  },
  strict: process.env.NODE_ENV !== 'production'
})
