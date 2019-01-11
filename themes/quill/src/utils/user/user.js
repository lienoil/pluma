import Cookies from 'js-cookie';

const user = {
  isLoggedIn: function () {
    return Cookies.get('user-token') || false;
  },
}

export default user;
