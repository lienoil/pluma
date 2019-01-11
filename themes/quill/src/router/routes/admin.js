const routes = []
const requireRoute = require.context(
  // The relative path of the routes folder
  '@/modules',
  // Whether or not to look in subfolders
  true,
  // The regular expression used to match base route filenames
  /routes\/admin\.js$/
)

requireRoute.keys().forEach(route => {
  const routeConfig = requireRoute(route)

  routeConfig.default.forEach(route => {
    routes.push(route)
  })
})

export default {
  path: '/admin',
  name: 'admin',
  redirect: { name: 'dashboard.index' },
  component: () => import('@/components/Layouts/Admin.vue'),
  meta: { title: 'Admin', authenticatable: true },
  children: routes,
}
