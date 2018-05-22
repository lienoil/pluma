import { localstorage } from './localstorage'
import { navigation } from './navigation'
import { settings } from './settings'

export default {
  install (Vue) {
    Vue.mixin(localstorage)
    Vue.mixin(navigation)
    Vue.mixin(settings)
  }
}
