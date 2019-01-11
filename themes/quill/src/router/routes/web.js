const routes = []
const requireRoute = require.context(
  // The relative path of the routes folder
  '@/modules',
  // Whether or not to look in subfolders
  true,
  // The regular expression used to match base route filenames
  /routes\/web\.js$/
)

requireRoute.keys().forEach(route => {
  const routeConfig = requireRoute(route)

  routeConfig.default.forEach(route => {
    routes.push(route)
  })
})

export default {
  path: '/',
  name: 'web',
  component: () => import('@/components/Layouts/Public.vue'),
  meta: { title: 'Admin', authenticatable: true },
  children: routes,
}
// export default routes
