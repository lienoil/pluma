import { localstorage } from './localstorage'
import { navigation } from './navigation'
import { settings } from './settings'
import { dialogbox } from './dialogbox'
import { bottomsheetbox } from './bottomsheetbox'

export default {
  install (Vue) {
    Vue.mixin(localstorage)
    Vue.mixin(navigation)
    Vue.mixin(settings)
    Vue.mixin(dialogbox)
    Vue.mixin(bottomsheetbox)
  }
}
