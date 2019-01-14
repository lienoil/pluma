import axios from 'axios'
import Cookies from 'js-cookie'
import store from '@/store'

/**
 * Retrieve and save the token if the response
 * bear the `token` property.
 *
 */
axios.interceptors.response.use((response) => {
  if (response.data.hasOwnProperty('token')) {
    window.localStorage.setItem('user-token', response.data.token)
    Cookies.set('user-token', response.data.token)
  }

  return response
})

axios.interceptors.response.use(undefined, function (err) {
  return new Promise(function (resolve, reject) {
    if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
      // if you ever get an unauthorized, logout the user
      store.dispatch('auth/AUTH_LOGOUT')
      // you can also redirect to /login if needed !
    }
    throw err;
  });
})

/**
 * Set the Authorization bearer on every request.
 *
 */
axios.defaults.headers.common['Authorization'] = Cookies.get('user-token')
axios.interceptors.request.use((request) => {
  if (Cookies.get('user-token')) {
    request.headers = {
      Authorization: 'Bearer ' + Cookies.get('user-token'),
    }
  }

  return request
})

window.axios = axios

export default axios
