import Vue from 'vue'
import Vuex from 'vuex'
import { mediathumbnail } from './modules/mediathumbnail'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    mediathumbnail
  },
  strict: process.env.NODE_ENV !== 'production'
})
