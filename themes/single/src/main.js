// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import '@/assets/stylus/main.styl'
import axios from 'axios'
import directives from './directives'
import filters from './filters'
import helpers from './helpers'
import mixins from './mixins'
import theme from './themes'
import components from './components'
import router from './router'
import store from './store'
import VeeValidate from 'vee-validate'
import Vue from 'vue'
import Vuetify from 'vuetify'

/**
 *------------------------------------------------------------------------------
 * Use Block
 *------------------------------------------------------------------------------
 * Vue.use statements
 *
 */
Vue.use(Vuetify, theme)
Vue.use(directives)
Vue.use(filters)
Vue.use(helpers)
Vue.use(mixins)
Vue.use(VeeValidate)

/**
 *------------------------------------------------------------------------------
 * Components Block
 *------------------------------------------------------------------------------
 * Here we define additional global components to be used throughout the app.
 * We require theme dynamically to avoid loading unused components.
 *
 */
Vue.use(components)

/**
 *------------------------------------------------------------------------------
 * Miscellaneous Configurations Block
 *------------------------------------------------------------------------------
 *
 */
// Axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers.common['Authorization'] = 'Bearer ' + document.head.querySelector('meta[name="api-token"]').getAttribute('content')
axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://pluma' : ''

// Vue Configurations
Vue.config.productionTip = false

// Vue Prototypes
Vue.prototype.$http = axios
Vue.prototype.$token = axios.defaults.headers.common['X-CSRF-TOKEN']
Vue.prototype.$user = window.$user || null

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  http: {
    headers: {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Authorization': 'Bearer ' + document.head.querySelector('meta[name="api-token"]').getAttribute('content')
    }
  },
  methods: {
    // routed () {
    //   let self = this
    //   this.$http.get('/api/v1/misc/routes')
    //     .then(response => {
    //       for (var i = 0; i < response.data.length; i++) {
    //         let current = response.data[i]
    //         self.routes.push({
    //           title: this.$root.trans(current.title),
    //           name: current.name,
    //           path: current.uri.replace(/{/g, ':').replace(/}/g, ''),
    //           meta: {
    //             title: current.title,
    //             description: current.description
    //           },
    //           component: () => import('./modules/' + current.component.replace(/\.vue/g, '') + '.vue'),
    //           beforeEnter: (to, from, next) => {
    //             if (to.path !== '/403' && (self.user.isRoot || self.user.permissions.indexOf(to.name) >= 0)) {
    //               next()
    //             } else {
    //               // self.alert({type: 'error', text: `Permission denied`})
    //               // window.location.href = '/403'
    //               next('/403')
    //             }
    //           }
    //         })
    //       }
    //       self.$router
    //         .addRoutes(self.routes)

    //       self.$router
    //         .beforeEach((to, from, next) => {
    //           document.title = to.meta.title
    //           next()
    //         })
    //     })
    //     .catch(error => {
    //       this.$root.alert({type: 'error', text: `Aw, Snap! Error fetching routes! It's severe! ${error.response}`})
    //     })
    // },
  }
})
