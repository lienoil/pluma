import Vue from 'vue'
import App from './App.vue'
import Vuetify from 'vuetify'

import vueEventCalendar from 'vue-event-calendar'

Vue.use(Vuetify)
Vue.use(vueEventCalendar, {locale: 'en'})

new Vue({
  el: '#app',
  render: h => h(App)
})
