export default [
  {
    path: '/admin',
    redirect: '/admin/dashboard'
  },
  {
    path: '/login',
    component: () => import('@/components/Layouts/Auth.vue'),
    children: [
      {
        title: 'Login',
        path: '',
        name: 'login.show',
        component: () => import('@/modules/Pluma/Auth/Login.vue'),
        meta: {
          title: 'Login',
          description: 'Sign in to the dashboard',
          authenticatable: false
        }
      }
    ]
  }
]
