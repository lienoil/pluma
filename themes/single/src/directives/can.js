export default {
  name: 'can',
  inserted: function (el, bindings, vnode) {
    const vm = vnode.context.$root
    const user = vm.$user
    const permissions = vm.$user.permissions
    const permission = bindings.value.code

    if (!user.isRoot && permissions.indexOf(permission) < 0) {
      el.remove()
    }
  }
}
