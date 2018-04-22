// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import '@/assets/stylus/main.styl'
import AlertIcon from '@/components/partials/AlertIcon.vue'
import axios from 'axios'
import Breadcrumbs from '@/components/partials/Breadcrumbs.vue'
import ImageOverlay from '@/components/components/ImageOverlay.vue'
import FormBuilder from '@/components/Form/Form.vue' // TODO: remove this from global
import Chatbox from '@/components/Chat/Chatbox.vue'
import filters from './filters'
import router from './router'
import VeeValidate from 'vee-validate'
import Vue from 'vue'
import Vuetify from 'vuetify'
import { settings } from './mixins/settings'
import _ from 'lodash'

Vue.use(filters)
Vue.use(VeeValidate)
Vue.use(Vuetify, {
  theme: {
    primary: '#30ad9d',
    secondary: '#ea4763',
    accent: '#fbde3c',
    success: '#81c106',
    warning: '#ff8017',
    error: '#ad2c1a',
    info: '#2196f3'
  }
})

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://pluma' : ''

Vue.config.productionTip = false
Vue.prototype.$http = axios
Vue.prototype.$token = axios.defaults.headers.common['X-CSRF-TOKEN']
// Lodash
Object.defineProperty(Vue.prototype, '_', { value: _ })

// Mixins
Vue.mixin(settings)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: {
    Breadcrumbs,
    AlertIcon,
    ImageOverlay,
    Chatbox,
    FormBuilder
  },
  http: {
    headers: {
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  watch: {
    '$route': function (router) {
      //
    }
  },
  data () {
    return {
      routes: [],
      navigations: {
        sidebar: []
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
    },
    routed () {
      let self = this
      // Populate the routes variable
      this.$http.get('/api/v1/misc/routes')
        .then(response => {
          for (var i = 0; i < response.data.length; i++) {
            let current = response.data[i]
            self.routes.push({
              title: current.title,
              name: current.name,
              path: current.uri.replace(/{/g, ':').replace(/}/g, ''),
              component: () => import('./' + current.component)
            })
          }
          self.$router.addRoutes(self.routes)
        })
        .catch(error => {
          // console.log('[ERROR]', error)
          this.$root.alert({type: 'error', text: `Aw, Snap! Error fetching routes! It's severe! ${error.response}`})
        })
    },
    navigation () {
      let self = this
      // Populate the routes variable
      this.$http.get('/api/v1/misc/navigations/sidebar')
        .then(response => {
          let sidebar = []

          for (let menu in response.data) {
            sidebar.push(response.data[menu])
          }

          sidebar = sidebar.sort(function (a, b) {
            return a.order - b.order
          })

          self.navigations.sidebar = sidebar
        })
        .catch(error => {
          // console.log('[ERROR]', error)
          this.$root.alert({type: 'error', text: `Aw, Snap! Error fetching routes! It's severe! ${error.response}`})
        })
    }
  },
  mounted () {
    this.navigation()
    this.routed()
  }
})
