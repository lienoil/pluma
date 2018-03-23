import Vue from 'vue'
import VueResource from 'vue-resource'
import Vuetify from 'vuetify'
import App from './App.vue'

Vue.use(Vuetify)
Vue.use(VueResource)

new Vue({
  el: '#app',
  render: h => h(App)
})