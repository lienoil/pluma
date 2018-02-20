// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import router from './router'
import Vuetify from 'vuetify'
import axios from 'axios'
import Breadcrumbs from '@/components/partials/Breadcrumbs.vue'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

Vue.config.productionTip = false

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

Vue.prototype.$http = axios

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
  data () {
    return {
      /**
       *------------------------------------------
       * Theme Settings
       *------------------------------------------
       *
       */
      theme: {
        dark: this.localstorage('theme.dark') === 'true',
        light: this.localstorage('theme.light') === 'true'
      },

      /**
       *------------------------------------------
       * Sidebar Settings
       *------------------------------------------
       *
       */
      sidebar: {
        clipped: this.localstorage('sidebar.clipped') === 'true',
        floating: this.localstorage('sidebar.floating') === 'true',
        mini: this.localstorage('sidebar.mini') === 'true',
        model: true
      }
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
  }
})
