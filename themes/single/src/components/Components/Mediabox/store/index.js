import Vue from 'vue'
import Vuex from 'vuex'
import { mediathumbnail } from './modules/mediathumbnail'
import { mediabox } from './modules/mediabox'
import { mediawindow } from './modules/mediawindow'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    mediabox,
    mediathumbnail,
    mediawindow,
  },
  strict: process.env.NODE_ENV !== 'production'
})
