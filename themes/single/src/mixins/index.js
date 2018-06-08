import { localstorage } from './localstorage'
import { navigation } from './navigation'
import { settings } from './settings'
import { dialogbox } from './dialogbox'

export default {
  install (Vue) {
    Vue.mixin(localstorage)
    Vue.mixin(navigation)
    Vue.mixin(settings)
    Vue.mixin(dialogbox)
  }
}
