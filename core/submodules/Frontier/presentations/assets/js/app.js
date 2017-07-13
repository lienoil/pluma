let router = new VueRouter({
    mode: 'hash',
    base: window.location.href,
    routes: []
});

const app = new Vue({
    // el:'v-app',
    router: router
}).$mount('v-app');
