// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import axios from 'axios'
import Breadcrumbs from '@/components/partials/Breadcrumbs.vue'
import filters from './filters'
import router from './router'
import { settings } from './mixins/settings'
import VeeValidate from 'vee-validate'
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(filters)
Vue.use(VeeValidate)
Vue.use(Vuetify, {
  theme: {
    primary: '#bb2481',
    secondary: '#222d32',
    accent: '#fdbe3c',
    error: '#FF5252',
    info: '#2196F3',
    success: '#4CAF50',
    warning: '#FFC107'
  }
})

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://pluma' : ''

Vue.config.productionTip = false
Vue.prototype.$http = axios
Vue.prototype.$token = axios.defaults.headers.common['X-CSRF-TOKEN']

// Mixins
Vue.mixin(settings)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: {
    Breadcrumbs
  },
  http: {
    headers: {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  watch: {
    '$route': function (router) {
      // Get sessions every page transition
      this.$http.post('/admin/sessions')
        .then(response => {
          if (typeof response.data.message !== 'undefined') {
            this.snackbar = Object.assign(this.snackbar, {
              model: true,
              color: response.data.type ? response.data.type : 'secondary',
              icon: response.data.icon ? response.data.icon : 'info',
              timeout: response.data.timeout ? response.data.timeout : 10000,
              text: response.data.message,
              title: response.data.title ? response.data.title : ''
            })
          }
        })
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
    }
  },
  mounted () {
    //
  }
})
