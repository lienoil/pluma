export default [
  {
    path: '/admin/courses',
    component: () => import('@/components/App.vue'),
    children: [
      {
        title: 'All Courses',
        path: '',
        name: 'courses.index',
        component: () => import('@/modules/Pluma/Course/Index.vue'),
        meta: {
          title: 'All Courses',
          authenticatable: false
        }
      },
      {
        title: 'Create Course',
        path: 'create',
        name: 'courses.create',
        component: () => import('@/modules/Pluma/Course/Create.vue'),
        meta: {
          title: 'Create Course',
          authenticatable: false
        }
      },
      {
        title: 'Show Course',
        path: 'show',
        name: 'courses.show',
        component: () => import('@/modules/Pluma/Course/Show.vue'),
        meta: {
          title: 'Show Course',
          authenticatable: false
        }
      },
      {
        title: 'Trashed Courses',
        path: '/admin/courses/trashed',
        name: 'courses.trashed',
        component: () => import('@/modules/Pluma/Course/Trashed.vue'),
        meta: {
          title: 'Trashed Courses',
          authenticatable: false
        }
      }
    ]
  }
]
