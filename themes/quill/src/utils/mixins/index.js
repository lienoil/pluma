import Vue from 'vue'
import trans from './translations.js'

const mixins = {
  install (Vue) {
    Vue.mixin(trans)
  }
}

Vue.use(mixins)
