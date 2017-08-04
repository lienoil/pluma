let ls = window.localStorage;

const app = new Vue({
    el: '#application-root',
    mixins : mixins,
    data() {
        return {
            dark: true, light: false,
            rightsidebar: {
                model: false,
            },
            sidebar: {
                floating: true,
                mini: false,
                drawer: true,
                state: {
                    model: 'Default',
                },
                states: ['Floating', 'Mini', 'Default'],
            },
            alert: {
                model: true,
            },
            dialog: {
                icon: null,
                model: false,
                yes: 'Confirm',
                no: 'Cancel',
                title: '',
                description: '',
                confirmHandler: () => {},
                cancelHandler: () => {},
            },
            settings: {
                fontsize: {
                    default: 16,
                    model: 14,
                },
            },
            menu: {
                open: false,
            },
            theme: {
                avatar: 'transparent',
                utilitybar: 'white',
            },
        };
    },
    mounted () {
        this.initData();
    },
    methods: {
        setStorage (key, value) {
            window.localStorage.setItem(key, value);
        },
        getStorage (key) {
            return window.localStorage.getItem(key);
        },
        clearStorage () {
            localStorage.clear();
        },
        initData() {
            this.settings.fontsize.model = this.getStorage('settings.fontsize') ? this.getStorage('settings.fontsize') : 16;

            this.sidebar.drawer = this.getStorage('sidebar.drawer') === 'true';
            this.sidebar.floating = this.getStorage('sidebar.floating') === 'true';
            this.sidebar.mini = this.getStorage('sidebar.mini') === 'true';
            this.sidebar.drawer = this.getStorage('sidebar.drawer') === 'true';
        },
        showDialog(meta) {
            this.dialog.icon = meta.icon;
            this.dialog.title = meta.title;
            this.dialog.description = meta.description;
            this.dialog.yes = meta.yes ? meta.yes : this.dialog.yes;
            this.dialog.no = meta.no ? meta.no : this.dialog.no;
            this.dialog.model = true;
            var parent = this.dialog;

            this.dialog.confirmHandler = function () {
                if (typeof meta.confirmHandler !== "undefined") {
                    meta.confirmHandler();
                }

                parent.model = false;
            };

            this.dialog.cancelHandler = function () {
                if (typeof meta.cancelHandler !== "undefined") {
                    meta.cancelHandler();
                }

                parent.model = false;
            };
        },

        dotToObject(key, value) {
            var result = object = {};
            var arr = key.split('.');
            for(var i = 0; i < arr.length-1; i++) {
                object = object[arr[i]] = {};
            }
            object[arr[arr.length-1]] = value;
            return result;
        },
    },
});
