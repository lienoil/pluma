import { focus } from './focus.js'
import can from './can.js'

export default {
  install (Vue) {
    Vue.directive(can.name, can)
    Vue.directive(focus.name, focus)
  }
}
