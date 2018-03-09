import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Declare storage for routes
// coming from the server
let routes = []

// Instance of VueRouter
const router = new VueRouter({
  mode: 'history',
  routes
})

// Check before loading the requested route
// router.beforeEach((to, from, next) => {
//   if (!to.matched.length) {
//     next('/404')
//   }

//   next()
// })

export default router
