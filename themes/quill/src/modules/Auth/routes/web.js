import { redirectToDashboardIfAuthenticated } from '@/middlewares/authenticatable'
import Cookies from 'js-cookie'
import logout from '@/utils/auth/logout'

export default [
  {
    path: '/auth',
    name: 'auth',
    redirect: { name: 'login.show' },
    component: () => import('@/components/Layouts/Auth.vue'),
    meta: {
      title: 'Login',
      sort: 0,
      authenticatable: false,
      icon: 'mdi-account-key',
    },
    children: [
      {
        path: '/login',
        name: 'login.show',
        component: () => import('../Signin.vue'),
        meta: {
          title: 'Sign In',
          sort: 0,
          icon: 'mdi-account-key',
        },
        beforeEnter: redirectToDashboardIfAuthenticated,
      },
      {
        path: '/logout',
        name: 'login.logout',
        meta: {
          title: 'Signout',
          icon: 'mdi-account-key',
        },
      },

      // Register
      // {
      //   path: '/register',
      //   name: 'register.show',
      //   component: () => import('../Signup.vue'),
      //   meta: {
      //     title: 'Sign Up',
      //     sort: 0,
      //     icon: 'mdi-account-key',
      //   },
      //   beforeEnter: (to, from, next) => {
      //     if (user()) {
      //       next({ name: 'admin' })
      //     } else {
      //       next()
      //     }
      //   },
      // },

      // // Passwords
      // {
      //   path: 'forgot/password',
      //   name: 'password.forgot',
      //   component: () => import('../ForgotPassword.vue'),
      //   meta: {
      //     title: 'Forgot Password',
      //     icon: 'mdi-account-key',
      //   },
      //   beforeEnter: (to, from, next) => {
      //     if (user()) {
      //       next({ name: 'admin' })
      //     } else {
      //       next()
      //     }
      //   },
      // },
    ],
  },
]
