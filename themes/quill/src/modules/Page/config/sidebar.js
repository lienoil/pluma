export default [
  {
    code: 'pages',
    name: 'pages',
    meta: {
      title: 'Page',
      icon: 'mdi-note-plus-outline',
      authenticatable: true,
      sort: 5,
    },
    children: [
      // Admin Page
      {
        code: 'pages.index',
        name: 'pages.index',
        meta: {
          title: 'All Pages',
          icon: 'mdi-home',
          authenticatable: true,
          sort: 5,
        },
      },

      // Create
      {
        code: 'pages.create',
        name: 'pages.create',
        meta: {
          title: 'Create Page',
          icon: 'mdi-home',
          authenticatable: true,
          sort: 5,
        },
      },

      // Divider
      {
        code: 'divider:courses/create.trashed',
        name: 'divider:courses/create.trashed',
        meta: {
          divider: true,
          sort: 7,
        },
      },

      // Archived
      {
        code: 'pages.archived',
        name: 'pages.archived',
        meta: {
          title: 'Archived Pages',
          icon: 'mdi-book-plus',
          authenticatable: true,
          sort: 8,
        },
      },
    ],
  }
]
