import {settings} from './settings'

export default {
  install (Vue) {
    Vue.mixin(settings)
  }
}
