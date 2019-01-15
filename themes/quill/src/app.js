/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue.
 */
// import '@/stylus/main.styl';

import './bootstrap';

import App from './App.vue';
import Vue from 'vue';

import './plugins/vuetify/vuetify.js';
import './plugins/vue/vue.js';
import './plugins/mdi/fonts.js';
import './plugins/axios/axios.js';
import './plugins/vee-validate/vee-validate.js';
import '@/plugins';

import router from './router/index';
// import store from '@/store';
import store from './store/index';


import '@/utils';

import '@/components';

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
