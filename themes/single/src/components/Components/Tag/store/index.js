import Vue from 'vue'
import Vuex from 'vuex'
import { tag } from './modules/tag'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    tag
  },
  strict: process.env.NODE_ENV !== 'production'
})
