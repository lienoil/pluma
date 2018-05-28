export default [
  {
    name: 'pages',
    path: '/admin/pages',
    component: () => import('@/modules/Pluma/Page/Index.vue'),
    children: [
      {
        title: 'All Pages',
        path: '',
        name: 'pages.index',
        component: () => import('@/modules/Pluma/Page/Index.vue')
      },
      {
        title: 'Create Page',
        path: 'create',
        name: 'pages.create',
        component: () => import('@/modules/Pluma/Page/Create.vue')
      }
    ]
  },
  {
    title: 'Trashed Pages',
    path: '/admin/pages/trashed',
    name: 'pages.trashed',
    component: () => import('@/modules/Pluma/Page/Trashed.vue')
  }
]
