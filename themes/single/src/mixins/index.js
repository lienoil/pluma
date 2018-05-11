import { settings } from './settings'
import { navigation } from './navigation'

export default {
  install (Vue) {
    Vue.mixin(settings)
    Vue.mixin(navigation)
  }
}
