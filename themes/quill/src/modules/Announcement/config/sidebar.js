export default [
  {
    code: 'announcements',
    name: 'announcements',
    meta: {
      title: 'Announcement',
      icon: 'mdi-home',
      authenticatable: true,
      sort: 5,
    },
    children: [
      // Admin Announcement
      {
        code: 'announcements.index',
        name: 'announcements.index',
        meta: {
          title: 'All Announcements',
          icon: 'mdi-home',
          authenticatable: true,
          sort: 5,
        },
      },
      // Archived
      {
        code: 'announcements.archived',
        name: 'announcements.archived',
        meta: {
          title: 'Archived Announcements',
          icon: 'mdi-book-plus',
          authenticatable: true,
          sort: 8,
        },
      },
    ],
  }
]
