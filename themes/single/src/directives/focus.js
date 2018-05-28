export default {
  name: 'focus',
  inserted: function (el) {
    el.focus()
    el.querySelector('input') && el.querySelector('input').focus()
  }
}
