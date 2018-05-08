import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Declare storage for routes
// coming from the server
let routes = []

// Instance of VueRouter
const router = new VueRouter({
  mode: 'history',
  saveScrollPosition: true,
  routes
})

export default router
