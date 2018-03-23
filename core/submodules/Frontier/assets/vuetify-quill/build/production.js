import Quill from '../src/Quill.vue'

Quill.install = function (Vue) {
  Vue.component(Quill.name, Quill)
}

export default Quill

if (typeof window !== 'undefined' && window.Vue) {
  Vue.use(Quill)
}
