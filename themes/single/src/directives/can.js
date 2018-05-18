export default {
  name: 'can',
  inserted: function (el, bindings, vnode) {
    const vm = vnode.context.$root
    let permissions = vm.user.permissions
    let permission = bindings.value.code

    if (!vm.user.isRoot && permissions.indexOf(permission) < 0) {
      el.remove()
    }
  }
}
