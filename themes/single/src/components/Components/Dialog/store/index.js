import Vue from 'vue'
import Vuex from 'vuex'
import { dialogbox } from './modules/dialogbox'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    dialogbox
  },
  strict: process.env.NODE_ENV !== 'production'
})
