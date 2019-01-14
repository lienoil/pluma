import Cookies from 'js-cookie'
// import { URL_POST_AUTHENTICATE } from '@/router/api'

const URL_POST_AUTHENTICATE = '/api/v1/authenticate'
const authenticate = token => new Promise((resolve, reject) => {
  window.axios({url: URL_POST_AUTHENTICATE, data: {token}, method: 'POST'})
    .then(response => {
      resolve(response)
    })
    .catch(err => {
      reject(err)
    })
})

export default authenticate
