export default [
  {
    name: 'users',
    path: '/admin/users',
    component: () => import('@/components/App.vue'),
    children: [
      {
        title: 'All Users',
        path: '',
        name: 'users.index',
        component: () => import('@/modules/Pluma/User/Index.vue'),
        meta: {
          title: 'All Users',
          description: 'Manage app users'
        }
      },
      {
        title: 'Create User',
        path: 'create',
        name: 'users.create',
        component: () => import('@/modules/Pluma/User/Create.vue'),
        meta: {
          title: 'Create User',
          description: 'Create new user'
        }
      },
      {
        title: 'Trashed Users',
        path: 'deactivated',
        name: 'users.trashed',
        component: () => import('@/modules/Pluma/User/Trashed.vue'),
        meta: {
          title: 'Deactivated Users',
          description: 'View list of all deactivated users'
        }
      }
    ]
  }
]
