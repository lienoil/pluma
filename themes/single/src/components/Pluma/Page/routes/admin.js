import PageCreate from '@/components/Pluma/Page/Create.vue'
import PageEdit from '@/components/Pluma/Page/Edit.vue'
import PageShow from '@/components/Pluma/Page/Show.vue'
import PageTrashed from '@/components/Pluma/Page/Trashed.vue'

export default {
  routes: [
    {
      name: 'pages.index',
      title: 'All Pages',
      path: '/admin/pages',
      component: () => import('@/components/Pluma/Page/Index.vue'),
      children: [
        { path: 'create', component: PageCreate, name: 'pages.create' },
        { path: 'trashed', component: PageTrashed, name: 'pages.trashed' },

        // Dynamic routes should be declared at the bottom
        { path: ':page', component: PageShow, name: 'pages.show' },
        { path: ':page/edit', component: PageEdit, name: 'pages.edit' }
      ]
    },
    { path: '/api/v1/pages/:page/destroy', name: 'pages.destroy', meta: { method: 'DELETE' } }
  ]
}
