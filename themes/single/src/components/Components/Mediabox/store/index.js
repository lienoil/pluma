import Vue from 'vue'
import Vuex from 'vuex'
import { mediathumbnail } from './modules/mediathumbnail'
import { mediabox } from './modules/mediabox'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    mediathumbnail,
    mediabox
  },
  strict: process.env.NODE_ENV !== 'production'
})
