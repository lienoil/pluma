import store from '@/store'

export const redirectToDashboardIfAuthenticated = (to, from, next) => {
  if (from.query && !from.query.validToken) {
    if (to.name !== 'login.show') {
      next({name: 'login.show'})
    } else {
      next()
    }
  }

  if (store.getters['auth/isAuthenticated']) {
    /**
     * proceed to dashboard
     * or the intended route.
     */
    const redirect = from.name || 'admin'
    next({name: redirect})
  } else {
    if (to.name !== 'login.show') {
      next({name: 'login.show'})
    } else {
      next()
    }
    return
  }
}

export const ifAuthenticated = (to, from, next) => {
  store.dispatch('auth/VALID_TOKEN')
    .then(() => {
      if (store.getters['auth/isAuthenticated']) {
        next()
        return
      }
      next({name: 'login.show'})
    })
    .catch(() => {
      if (to.name !== 'login.show') {
        next({name: 'login.show', query: { validToken: false }})
      } else {
        next()
      }
    })
}

export const authenticatable = {
  redirectToDashboardIfAuthenticated,
  authenticatable,
}
