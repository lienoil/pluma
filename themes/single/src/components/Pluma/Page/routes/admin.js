import PageTrashed from '@/components/Pluma/Page/Trashed.vue'
import PageIndex from '@/components/Pluma/Page/Index.vue'
import PageCreate from '@/components/Pluma/Page/Create.vue'
import PageShow from '@/components/Pluma/Page/Show.vue'
import PageEdit from '@/components/Pluma/Page/Edit.vue'

export default {
  name: 'page',
  router: [
    { path: '/admin/pages/trashed', component: PageTrashed, name: 'pages.trashed' },
    { path: '/admin/pages/create', component: PageCreate, name: 'pages.create' },
    { path: '/admin/pages/:page/edit', component: PageEdit, name: 'pages.edit' },
    { path: '/admin/pages/:page', component: PageShow, name: 'pages.show' },
    { path: '/admin/pages', component: PageIndex, name: 'pages.index' },
    { path: '/admin', redirect: '/admin/dashboard' }
  ]
}
