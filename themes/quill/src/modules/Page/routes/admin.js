export default [
  {
    path: '/admin/pages',
    component: () => import('@/App.vue'),
    meta: {
      title: 'Pages',
      sort: 6,
      authenticatable: true,
      icon: 'mdi-book-multiple-variant',
    },
    children: [
      {
        path: '',
        props: true,
        name: 'pages.index',
        component: () => import('../Index.vue'),
        meta: {
          title: 'All Pages',
          sort: 6,
          authenticatable: true,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'create',
        props: true,
        name: 'pages.create',
        component: () => import('../Create.vue'),
        meta: {
          title: 'Create Page',
          authenticatable: true,
          icon: 'mdi-delete-outline'

        }
      },
      // {
      //   path: ':code',
      //   props: true,
      //   name: 'pages.show',
      //   component: () => import('../Show.vue'),
      //   meta: {
      //     title: 'Show Page',
      //     authenticatable: true,
      //     icon: 'mdi-delete-outline'
      //   }
      // },
      {
        path: ':code',
        props: true,
        name: 'pages.show',
        component: () => import('../Show.vue'),
        meta: {
          title: 'Show Page',
          sort: 1,
          external: true,
          excludeFromRoot: true,
          authenticatable: false,
          icon: 'mdi-book-multiple-variant',
        },
      },
      {
        path: 'edit',
        props: true,
        name: 'pages.edit',
        component: () => import('../Edit.vue'),
        meta: {
          title: 'Edit Page',
          authenticatable: true,
          icon: 'mdi-delete-outline'

        }
      },
      {
        path: 'archived',
        props: true,
        name: 'pages.archived',
        component: () => import('../Archived.vue'),
        meta: {
          title: 'Archived Page',
          authenticatable: true,
          icon: 'mdi-delete-outline'

        }
      }
    ],
  }
]
