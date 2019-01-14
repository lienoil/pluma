import '@/stylus/main.styl';
import Vue from 'vue';
import Vuetify from 'vuetify';
// import theme from '@/themes';

Vue.use(Vuetify, {
  theme: {
    primary: '#0C5689', // _.$primary, // '#0C5689',
    secondary: '#e56e37', // _.$secondary,
    accent: '#00BEDD', // _.$accent,
    success: '#30A300', // _.$success,
    warning: '#EAC011', // _.$warning,
    error: '#F44336', // _.$error,
    info: '#00B8D6', // _.$info
  }
});
