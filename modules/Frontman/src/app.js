import App from './App.vue';
import Vue from 'vue';
import VueResource from 'vue-resource';
import Vuetify from 'vuetify';

Vue.use(Vuetify);
Vue.use(VueResource);

const app = new Vue({
  el: '#app',
  render: h => h(App)
})
