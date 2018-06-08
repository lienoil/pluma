export default [
  {
    path: '/admin/pages',
    component: () => import('@/components/App.vue'),
    children: [
      {
        title: 'All Pages',
        path: '',
        name: 'pages.index',
        component: () => import('@/modules/Pluma/Page/Index.vue'),
        meta: {
          title: 'All Pages',
          authenticatable: true
        }
      },
      {
        title: 'Create Page',
        path: 'create',
        name: 'pages.create',
        component: () => import('@/modules/Pluma/Page/Create.vue'),
        meta: {
          title: 'Create Page',
          authenticatable: true
        }
      },
      {
        title: 'Trashed Pages',
        path: '/admin/pages/trashed',
        name: 'pages.trashed',
        component: () => import('@/modules/Pluma/Page/Trashed.vue'),
        meta: {
          title: 'Trashed Pages',
          authenticatable: true
        }
      }
    ]
  }
]
