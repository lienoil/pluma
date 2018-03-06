import Vue from 'vue'
import Router from 'vue-router'
import PageAdminRoutes from '@/components/Pluma/Page/routes/admin'

Vue.use(Router)

let routes = []
routes.concat(PageAdminRoutes.routes)

export default new Router({
  mode: 'history',
  routes
})
