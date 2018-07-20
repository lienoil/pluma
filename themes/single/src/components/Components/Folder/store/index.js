import Vue from 'vue'
import Vuex from 'vuex'
import { folder } from './modules/folder'
import { contextmenu } from './modules/contextmenu'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    folder,
    contextmenu,
  },
  strict: process.env.NODE_ENV !== 'production'
})
