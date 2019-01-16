export default [
  {
    path: '/admin/users',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Users',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '',
        props: true,
        name: 'users.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Users',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'create',
        props: true,
        name: 'users.create',
        component: () => import('../Create.vue'),
        meta: {
          title: 'Create User',
          authenticatable: true,
          icon: 'mdi-delete-outline'

        }
      },
      {
        path: 'show',
        props: true,
        name: 'users.show',
        component: () => import('../Show.vue'),
        meta: {
          title: 'Show User',
          authenticatable: true,
          icon: 'mdi-delete-outline'

        }
      },
      {
        path: 'edit',
        props: true,
        name: 'users.edit',
        component: () => import('../Edit.vue'),
        meta: {
          title: 'Edit User',
          authenticatable: true,
          icon: 'mdi-delete-outline'

        }
      },
      {
        path: 'archived',
        props: true,
        name: 'users.archived',
        component: () => import('../Archived.vue'),
        meta: {
          title: 'Archived User',
          authenticatable: true,
          icon: 'mdi-delete-outline'

        }
      }
    ],
  }
]
