import route from './route.js'
import trans from './trans.js'

export default {
  install (Vue) {
    Vue.mixin(trans)
    Vue.mixin(route)
  }
}
