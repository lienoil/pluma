import Cookies from 'js-cookie'
import login from '@/utils/auth/login'
import authenticate from '@/utils/auth/authenticate'

const AUTH_REQUEST = 'AUTH_REQUEST'
const AUTH_SUCCESS = 'AUTH_SUCCESS'
const AUTH_ERROR = 'AUTH_ERROR'
const AUTH_LOGOUT = 'AUTH_LOGOUT'
const AUTH_AUTHENTICATE = 'AUTH_AUTHENTICATE'
const VALID_TOKEN = 'VALID_TOKEN'

export const state = () => ({
  token: Cookies.get('user-token') || localStorage.getItem('user-token') || '',
  status: '',
})

export const getters = {
  isAuthenticated: state => !!state.token,
  authStatus: state => state.status,
}

export const actions = {
  [AUTH_REQUEST]: ({commit, dispatch}, user) => {
    return new Promise((resolve, reject) => {
      commit(AUTH_REQUEST)
      login(user)
        .then(() => {
          commit(AUTH_SUCCESS, Cookies.get('user-token'))
          dispatch(USER_REQUEST)
        })
        .catch(err => {
          commit(AUTH_ERROR, err)
        })
    })
  },

  [AUTH_AUTHENTICATE]: ({commit, dispatch}) => {
    return new Promise((resolve, reject) => {
      commit(AUTH_AUTHENTICATE)
      authenticate(Cookies.get('user-token'))
        .then(() => {
          commit(AUTH_SUCCESS, Cookies.get('user-token'))
          dispatch(USER_REQUEST)
        })
        .catch(err => {
          commit(AUTH_ERROR, err)
        })

      resolve()
    })
  },

  [AUTH_LOGOUT]: ({commit, dispatch}) => {
    return new Promise((resolve, reject) => {
      commit(AUTH_LOGOUT)
      Cookies.remove('user-token')
      localStorage.removeItem('user-token')
      delete axios.defaults.headers.common['Authorization']
      resolve()
    })
  },

  [VALID_TOKEN]: ({commit, dispatch}) => {
    return new Promise((resolve, reject) => {
      commit(VALID_TOKEN)
      authenticate(Cookies.get('user-token'))
        .then((response) => {
          resolve(response)
        })
        .catch(err => {
          if (!err.response.data.success) {
            Cookies.remove('user-token')
            localStorage.removeItem('user-token')
            delete axios.defaults.headers.common['Authorization']
          }
          reject(err)
        })
    })
  },
}

export const mutations = {
  [AUTH_REQUEST]: (state) => {
    state.status = 'loading'
  },
  [AUTH_SUCCESS]: (state, token) => {
    state.status = 'success'
    state.token = token
  },
  [AUTH_ERROR]: (state) => {
    state.status = 'error'
  },
  [AUTH_LOGOUT]: (state) => {
    state.status = 'loggedout'
  },
  [AUTH_AUTHENTICATE]: (state) => {
    state.status = 'authenticating'
  },
  [VALID_TOKEN]: (state) => {
    state.status = 'validating token'
  }
}


export const auth = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}
