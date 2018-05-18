import { focus } from './focus.js'
import can from './can.js'
import title from './title.js'

export default {
  install (Vue) {
    Vue.directive(can.name, can)
    Vue.directive(focus.name, focus)
    Vue.directive(title.name, title)
  }
}
