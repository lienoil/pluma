export default [
  {
    path: '*',
    name: 'error.404',
    component: () => import('@/components/Errors/404.vue'),
    meta: {
      title: '404 Not Found',
      excludeInMenu: true,
      sort: 10000,
      external: true,
      excludeFromRoot: true,
      authenticatable: false,
    },
  },
]
