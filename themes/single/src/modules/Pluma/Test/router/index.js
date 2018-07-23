export default [
  {
    path: '/admin/tests',
    component: () => import('@/components/App.vue'),
    children: [
      {
        title: 'All Tests',
        path: '',
        name: 'tests.index',
        component: () => import('@/modules/Pluma/Test/Index.vue'),
        meta: {
          title: 'All Tests',
          authenticatable: false
        }
      },
      {
        title: 'Create Test',
        path: 'create',
        name: 'tests.create',
        component: () => import('@/modules/Pluma/Test/Create.vue'),
        meta: {
          title: 'Create Test',
          authenticatable: false
        }
      },
      {
        title: 'Show Test',
        path: 'show',
        name: 'tests.show',
        component: () => import('@/modules/Pluma/Test/Show.vue'),
        meta: {
          title: 'Show Test',
          authenticatable: false
        }
      },
      {
        title: 'Trashed Tests',
        path: '/admin/tests/trashed',
        name: 'tests.trashed',
        component: () => import('@/modules/Pluma/Test/Trashed.vue'),
        meta: {
          title: 'Trashed Tests',
          authenticatable: false
        }
      }
    ]
  }
]
