export default {
  name: 'title',
  inserted: function (el, bindings, vnode) {
    if (el.querySelector('input')) {
      el.querySelector('input').classList.add('primary-title')
    } else {
      el.classList.add('primary-title')
    }
  }
}
