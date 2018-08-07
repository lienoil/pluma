import Vue from 'vue'
import Vuex from 'vuex'
import { dataiterator } from './modules/dataiterator'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    dataiterator
  },
  strict: process.env.NODE_ENV !== 'production'
})
