import Vue from 'vue'
import VueRouter from 'vue-router'
import _includes from 'lodash/_arrayIncludes'

Vue.use(VueRouter)

// Routes collection
const routes = []
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

  routeConfig.default.forEach(route => {
    routes.push(route)
  })
})

// Instance of VueRouter
const router = new VueRouter({
  base: '/',
  mode: 'history',
  saveScrollPosition: true,
  routes
})

// Guard
router.beforeEach((to, from, next) => {
  document.title = (to.meta && to.meta.title) || (to.labels && to.labels.title) || document.title

  if (to.meta.authenticatable && !_includes(window.$user.permissions, to.name)) {
    // window.location.href = to.path
    // next()
  }

  next()
})

export default router
