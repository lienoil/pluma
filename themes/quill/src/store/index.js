import Vue from 'vue'
import Vuex from 'vuex'
import { modules } from '@/store/components/components'

Vue.use(Vuex)

export default new Vuex.Store({
  modules,
  // Making sure that we're doing
  // everything correctly by enabling
  // strict mode in the dev environment.
  strict: process.env.NODE_ENV !== 'production'
})
