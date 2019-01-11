import axios from 'axios';
import Cookies from 'js-cookie';

/**
 * Retrieve and save the token if the response
 * bear the `token` property.
 *
 */
axios.interceptors.response.use((response) => {
  if (response.data.hasOwnProperty('token')) {
    window.localStorage.setItem('user-token', response.data.token);
    Cookies.set('user-token', response.data.token);
  }

  return response;
});

/**
 * Set the Authorization bearer on every request.
 *
 */
axios.interceptors.request.use((request) => {
  if (Cookies.get('user-token')) {
    request.headers = {
      Authorization: 'Bearer ' + Cookies.get('user-token'),
    }
  }

  return request;
});

window.axios = axios;

export default axios
