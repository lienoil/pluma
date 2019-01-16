export default [
  {
    code: 'users',
    name: 'users',
    meta: {
      title: 'User',
      icon: 'mdi-home',
      authenticatable: true,
      sort: 5,
    },
    children: [
      // Admin User
      {
        code: 'users.index',
        name: 'users.index',
        meta: {
          title: 'All Users',
          icon: 'mdi-home',
          authenticatable: true,
          sort: 5,
        },
      },
      // Archived
      {
        code: 'users.archived',
        name: 'users.archived',
        meta: {
          title: 'Archived Users',
          icon: 'mdi-book-plus',
          authenticatable: true,
          sort: 8,
        },
      },
    ],
  }
]
