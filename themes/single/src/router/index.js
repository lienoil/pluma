import Vue from 'vue'
import VueRouter from 'vue-router'
import PageIndex from '@/components/Pluma/Page/Index.vue'

Vue.use(VueRouter)

// Declare storage for routes
// coming from the server
let routes = [
  { path: '/admin/pages', component: PageIndex, name: 'pages.index' }
]

// Instance of VueRouter
const router = new VueRouter({
  mode: 'history',
  routes
})

// // Check before loading the requested route
// router.beforeEach((to, from, next) => {
//   if (!to.matched.length) {
//     next('/404')
//   }

//   next()
// })

export default router
