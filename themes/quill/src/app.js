/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue.
 */

import './bootstrap';

import App from './App.vue';
import Vue from 'vue';

import router from '@/router';
import store from '@/store';

import '@/utils';
import '@/plugins';
import '@/components';

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App),
}).$mount('#app');
