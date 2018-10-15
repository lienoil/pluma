export default {
  name: 'slugify',
  filter: (value) => {
    if (value !== '') {
      value = value.replace(/^\s+|\s+$/g, '') // trim
      value = value.toLowerCase()

      // remove accents, swap ñ for n, etc
      var from = 'ãàáäâẽèéëêìíïîõòóöôùúüûñç·,:;!\'"/'
      var to = 'aaaaaeeeeeiiiiooooouuuunc---------'
      for (var i = 0, l = from.length; i < l; i++) {
        value = value.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i))
      }

      value = value.replace(/[^a-z0-9 -/]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/\/+/g, '/')
        .replace(/-+/g, '-') // collapse dashes
    }

    return value
  }
}
