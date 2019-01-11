export default [
  {
    path: '/admin/announcements',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Announcements',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '',
        props: true,
        name: 'announcements.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Announcements',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
    ],
  }
]
