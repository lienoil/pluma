import NotFoundComponent from '@/components/Pluma/Errors/NotFoundComponent.vue'
// import PageCreate from '@/components/Pluma/Page/Create.vue'
// import PageEdit from '@/components/Pluma/Page/Edit.vue'
// import PageIndex from '@/components/Pluma/Page/Index.vue'
// import PageShow from '@/components/Pluma/Page/Show.vue'
// import PageTrashed from '@/components/Pluma/Page/Trashed.vue'
import PageAdminRoutes from '@/components/Pluma/Page/routes/admin.js'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

let routes = [
  // { path: '/admin', redirect: '/admin/dashboard' },
  // { path: '/admin/pages', component: PageIndex, name: 'pages.index' },
  // { path: '/admin/pages/create', component: PageCreate, name: 'pages.create' },
  // { path: '/admin/pages/trashed', component: PageTrashed, name: 'pages.trashed' },
  // { path: '/admin/pages/:page', component: PageShow, name: 'pages.show' },
  // { path: '/admin/pages/:page/edit', component: PageEdit, name: 'pages.edit' },
  // { path: '/api/v1/pages/:page/destroy', name: 'pages.destroy', meta: { method: 'DELETE' } },
  { path: '/404', component: NotFoundComponent }
]

routes = routes.concat(PageAdminRoutes.routes)

const router = new VueRouter({
  mode: 'history',
  routes
})

router.beforeEach((to, from, next) => {
  if (!to.matched.length) {
    next('/404')
  }

  next()
})

export default router
