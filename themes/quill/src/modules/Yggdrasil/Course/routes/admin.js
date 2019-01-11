export default [
  {
    path: '/admin/courses',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Courses',
      description: 'Manage all available courses.',
      icon: 'mdi-book-open-page-variant',
      authenticatable: true,
      permission: 'courses.index',
    },
    children: [

      {
        path: '/',
        name: 'courses.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'Courses',
          description: 'Manage all available courses.',
          icon: 'mdi-book-open-page-variant',
          authenticatable: true,
          permission: 'courses.index',
        },
      },

      {
        path: '/admin/courses/create',
        name: 'courses.create',
        component: () => import('../Create.vue'),
        meta: {
          title: 'New Courses',
          description: 'Add new course.',
          authenticatable: true,
          permission: 'courses.create',
        },
      },

      {
        path: '/admin/courses/archived',
        name: 'courses.archived',
        component: () => import('../Trashed.vue'),
        meta: {
          title: 'Archived Courses',
          description: 'View and manage archived courses.',
          authenticatable: true,
          permission: 'courses.trashed',
        },
      },

    ],
  },
]
