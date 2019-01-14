import Cookies from 'js-cookie'
// import { URL_POST_LOGIN } from '@/router/api'

const URL_POST_LOGIN = '/api/v1/login'
const login = user => new Promise((resolve, reject) => {
  window.axios({url: URL_POST_LOGIN, data: user, method: 'POST'})
    .then(response => {
      const token = response.data.token
      // const id = response.data.user.id
      Cookies.set('user-token', token)
      resolve(response)
    })
    .catch(err => {
      Cookies.remove('user-token')
      reject(err)
    })
})

export default login
