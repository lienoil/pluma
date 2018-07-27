import Vue from 'vue'
import Vuex from 'vuex'
import { base } from './base'
import { category } from '@/components/Components/Category/store/modules/category'
import { coverimage } from '@/components/Components/CoverImage/store/modules/coverimage'
import { dataiterator } from '@/components/Components/DataIterator/store/modules/dataiterator'
import { datatable } from '@/components/Components/DataTable/store/modules/datatable'
import { dialogbox } from '@/components/Components/Dialog/store/modules/dialogbox'
import { iconmenu } from '@/components/Components/IconMenu/store/modules/iconmenu'
import { snackbar } from '@/components/Components/Snackbar/store/modules/snackbar'
import { tag } from '@/components/Components/Tag/store/modules/tag'
import { timeline } from '@/components/Components/Timeline/store/modules/timeline'
import { toolbar } from '@/components/Components/Toolbar/store/modules/toolbar'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    base,
    category,
    coverimage,
    dataiterator,
    datatable,
    dialogbox,
    iconmenu,
    snackbar,
    tag,
    timeline,
    toolbar,
  },
  // Making sure that we're doing
  // everything correctly by enabling
  // strict mode in the dev environment.
  strict: process.env.NODE_ENV !== 'production'
})
