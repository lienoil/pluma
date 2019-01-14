import Vue from 'vue'
import Vuex from 'vuex'
import { components } from '@/store/components'
import { modules } from '@/store/modules'

Vue.use(Vuex)

const storeModules = Object.assign({}, modules, components)

export default new Vuex.Store({
  modules: storeModules,
  // Making sure that we're doing
  // everything correctly by enabling
  // strict mode in the dev environment.
  strict: process.env.NODE_ENV !== 'production'
})
