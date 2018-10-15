export const localstorage = {
  methods: {
    localstorage (key, value) {
      // Check if setting
      if (typeof key === 'object') {
        return Object.keys(key).forEach(k => {
          return window.localStorage.setItem(k, key[k])
        })
      } else {
        return typeof window.localStorage.getItem(key) !== 'undefined'
          ? window.localStorage.getItem(key)
          : value
      }
    }
  }
}
