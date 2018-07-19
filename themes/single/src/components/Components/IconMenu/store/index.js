import Vue from 'vue'
import Vuex from 'vuex'
import { iconmenu } from './modules/iconmenu'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    iconmenu
  },
  strict: process.env.NODE_ENV !== 'production'
})
