// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import '@/assets/stylus/main.styl'
import AlertIcon from '@/components/partials/AlertIcon.vue'
import axios from 'axios'
import Breadcrumbs from '@/components/partials/Breadcrumbs.vue'
import filters from './filters'
import router from './router'
import VeeValidate from 'vee-validate'
import Vue from 'vue'
import Vuetify from 'vuetify'
import { settings } from './mixins/settings'

Vue.use(filters)
Vue.use(VeeValidate)
Vue.use(Vuetify, {
  theme: {
    primary: '#bb2481',
    accent: '#FFC107',
    secondary: '#350423',
    info: '#2196F3',
    warning: '#F8BB86',
    error: '#FF5252',
    success: '#4CAF50'
  }
})

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://pluma' : ''

Vue.config.productionTip = false
Vue.prototype.$http = axios
Vue.prototype.$token = axios.defaults.headers.common['X-CSRF-TOKEN']

router.addRoutes([{
  name: 'pages.index',
  path: '/admin/pages',
  component: require('./components/Pluma/Page/Index.vue')
}])

// Mixins
Vue.mixin(settings)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: {
    Breadcrumbs, AlertIcon
  },
  http: {
    headers: {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  watch: {
    '$route': function (router) {
      this.routed()
      // this.$root.alert({type: 'success', text: `Hey you've changed the page! Awesome!`})
    }
  },
  methods: {
    localstorage (key, value) {
      if (typeof value === 'undefined') {
        // get localstorage
        return window.localStorage.getItem(key)
      } else {
        window.localStorage.setItem(key, value)
        return true
      }
    },
    routed () {
      let self = this
      // Populate the routes variable
      this.$http.get('/$/routes')
        .then(response => {
          let routes = []
          for (var i = 0; i < response.data.length; i++) {
            let current = response.data[i]
            this.$router.options.routes.push({
              name: current.name,
              path: current.uri,
              component: require('@/' + current.component)
            })
          }
          self.$router.addRoutes(routes)
          console.log('[ROUTER]', this.$router.options.routes)
          // this.$root.alert({theme: 'light', color: 'white', type: 'success', text: `Welcome to the site!`})
        })
        .catch(error => {
          // console.log('[ERROR]', error)
          this.$root.alert({type: 'error', text: `Aw, Snap! Error fetching routes! It's severe! ${error.response}`})
        })
    }
  },
  mounted () {
    this.routed()
  }
})
