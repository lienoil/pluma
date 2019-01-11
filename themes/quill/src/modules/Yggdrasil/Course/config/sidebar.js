export default [
  {
    code: 'courses',
    name: 'courses',
    meta: {
      title: 'Courses',
      icon: 'mdi-book-open-page-variant',
      authenticatable: true,
      sort: 4,
    },
    children: [
      // Admin Courses
      {
        code: 'courses.index',
        name: 'courses.index',
        meta: {
          title: 'All Courses',
          icon: 'mdi-book-open-page-variant',
          authenticatable: true,
          sort: 5,
        },
      },

      // Create
      {
        code: 'courses.create',
        name: 'courses.create',
        meta: {
          title: 'Create Course',
          icon: 'mdi-book-plus',
          authenticatable: true,
          sort: 6,
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
        code: 'courses.archived',
        name: 'courses.archived',
        meta: {
          title: 'Archived Courses',
          icon: 'mdi-delete-empty',
          authenticatable: true,
          sort: 8,
        },
      },
    ],
  }
]
