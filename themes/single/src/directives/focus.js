export default {
  name: 'focus',
  inserted: function (el, bindings) {
    const target = bindings.value ? bindings.value.target : undefined

    if (typeof target !== 'undefined') {
      el = document.querySelector(target)
    }

    el.focus()
    el.querySelector('input') && el.querySelector('input').focus()
  }
}
