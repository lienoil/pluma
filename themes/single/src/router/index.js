import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Routes collection
const routes = []

// Instance of VueRouter
const router = new VueRouter({
  mode: 'history',
  saveScrollPosition: true,
  routes
})

const requireRoute = require.context(
  // The relative path of the routes folder
  '@/modules',
  // Whether or not to look in subfolders
  true,
  // The regular expression used to match base route filenames
  /router\/index\.js$/
)

requireRoute.keys().forEach(route => {
  const routeConfig = requireRoute(route)
  router.addRoutes(routeConfig.default || routeConfig)
})

router.beforeEach((to, from, next) => {
  document.title = (to.meta && to.meta.title) || (to.labels && to.labels.title) || document.title

  next()
})

export default router
