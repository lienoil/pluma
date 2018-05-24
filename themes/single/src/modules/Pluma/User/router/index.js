export default [
  {
    title: 'All Users',
    path: '/admin/users',
    name: 'users.index',
    component: () => import('@/modules/Pluma/User/Index.vue')
  },
  {
    title: 'Create User',
    path: '/admin/users/create',
    name: 'users.create',
    component: () => import('@/modules/Pluma/User/Create.vue')
  },
  {
    title: 'Trashed Users',
    path: '/admin/users/trashed',
    name: 'users.trashed',
    component: () => import('@/modules/Pluma/User/Trashed.vue')
  }
]
