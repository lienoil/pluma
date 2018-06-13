import Vue from 'vue'
import Vuex from 'vuex'
import { snackbar } from '@/components/Components/Snackbar/store/modules/snackbar'
import { dialogbox } from '@/components/Components/Dialog/store/modules/dialogbox'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    snackbar,
    dialogbox
  },
  // Making sure that we're doing
  // everything correctly by enabling
  // strict mode in the dev environment.
  strict: process.env.NODE_ENV !== 'production'
})
