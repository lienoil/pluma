export default [
  {
    path: '/admin/dashboard',
    name: 'dashboard.index',
    component: () => import('../Dashboard.vue'),
    meta: {
      title: 'Dashboard',
      description: 'Overview of the app.',
      sort: 0,
      authenticatable: true,
      icon: 'dashboard',
    },
  },
  {
    path: '/admin/dashboard',
    name: 'divider:dashboard',
    meta: {
      sort: 1,
      divider: true,
      height: 2,
    }
  }
]
