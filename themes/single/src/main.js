// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import axios from 'axios'
import Breadcrumbs from '@/components/partials/Breadcrumbs.vue'
import filters from './filters'
import router from './router'
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

Vue.config.productionTip = false

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://pluma' : ''

Vue.prototype.$http = axios
Vue.prototype.$token = axios.defaults.headers.common['X-CSRF-TOKEN']

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
      app: {},
      settings: {
        fontsize: this.localstorage('settings.fontsize') ? this.localstorage('settings.fontsize') : 1
      },
      view: {
        current: 'PageIndex'
      },

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
      },

      /**
       *------------------------------------------
       * Snackbar Settings
       *------------------------------------------
       *
       */
      snackbar: {
        color: 'secondary',
        icon: 'info',
        timeout: 10000,
        model: false,
        title: '',
        text: '',
        x: 'right',
        y: 'top'
      },

      /**
       *------------------------------------------
       * Rightsidebar Settings
       *------------------------------------------
       *
       */
      rightsidebar: {
        clipped: this.localstorage('rightsidebar.clipped') === 'true',
        floating: this.localstorage('rightsidebar.floating') === 'true',
        mini: this.localstorage('rightsidebar.mini') === 'true',
        model: false
      },

      /**
       *------------------------------------------
       * Flash Session
       *------------------------------------------
       *
       * FLASH! Ah-haaaaaaaaa
       * Saviour of the universe!
       * FLASH! Ah-haaaaaaaaa
       * He'll save everyone of us!
       *
       */
      flash: {
        model: false
      }
    }
  },
  watch: {
    '$route': function (router) {
      // Get sessions every page transition
      this.$http.post('/sessions')
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
    this.app = this
  }
})
