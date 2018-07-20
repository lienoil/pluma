import Vue from 'vue'
import Vuex from 'vuex'
import { base } from './base'
import { snackbar } from '@/components/Components/Snackbar/store/modules/snackbar'
import { dialogbox } from '@/components/Components/Dialog/store/modules/dialogbox'
import { iconmenu } from '@/components/Components/IconMenu/store/modules/iconmenu'
import { dataiterator } from '@/components/Components/DataIterator/store/modules/dataiterator'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    base,
    snackbar,
    dialogbox,
    iconmenu,
    dataiterator
  },
  // Making sure that we're doing
  // everything correctly by enabling
  // strict mode in the dev environment.
  strict: process.env.NODE_ENV !== 'production'
})
