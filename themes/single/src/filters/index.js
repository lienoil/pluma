import slugify from './slugify'

export default {
  install (Vue) {
    Vue.filter(slugify.name, slugify.filter)
  }
}
