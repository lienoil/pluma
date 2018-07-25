import Vue from 'vue'
import Vuex from 'vuex'
import { mediathumbnail } from './modules/mediathumbnail'
import { mediabox } from './modules/mediabox'
import { mediawindow } from './modules/mediawindow'
import { folder } from './modules/folder'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    mediabox,
    mediathumbnail,
    mediawindow,
    folder,
  },
  strict: process.env.NODE_ENV !== 'production'
})
