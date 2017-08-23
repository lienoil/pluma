export default {
    data () {
        return {
            dataset: {
                pagination: {},
            },
        };
    },
    methods: {
        api () {
            let self = this;
            return {
                search (url, query, prefix) {
                    return new Promise((resolve, reject) => {
                        query = query ? self.serialize(query) : self.serialize({});
                        prefix = prefix ? prefix : '?';
                        url = url+prefix+query;

                        self.$http.get(url).then((response) => {
                            let items = response.body;
                            const total = response.body.data.total ? response.body.data.total : response.body.total;

                            resolve({items, total});
                        })

                    });
                },

                get (url, query, options, prefix) {
                    return new Promise((resolve, reject) => {
                        query = query ? self.serialize(query) : self.serialize({});
                        prefix = prefix ? prefix : '?';
                        url = url+prefix+query;

                        self.$http.get(url).then((response) => {
                            let items = response.body;
                            const total = typeof response.body.data != 'undefined' ? response.body.data.total : response.body.length;

                            resolve({items, total});
                        });

                    });
                },

                post (url, query) {
                    return new Promise((resolve, reject) => {
                        self.$http.post(url, query).then((response) => {
                            let items = response.body;
                            const total = response.body.total ? response.body.total : response.body.length;

                            resolve({items, total});
                        })

                    });
                },

                delete (url, query) {
                    return new Promise((resolve, reject) => {
                        self.$http.delete(url, self.serialize(query)).then((response) => {
                            self.get();
                            resolve({response});
                        });
                    });
                },
            }
        },

        searchAPI (url, query, prefix) {
            return new Promise((resolve, reject) => {
                query = query ? this.serialize(query) : this.serialize({});
                prefix = prefix ? prefix : '?';
                url = url+prefix+query;

                this.$http.get(url).then((response) => {
                    let items = response.body;
                    const total = response.body.data.total ? response.body.data.total : response.body.total;

                    resolve({items, total});
                })

            });
        },

        getAPI (url, query, options) {
            return new Promise((resolve, reject) => {
                let q = "?d="+ new Date().getYear();
                query = query ? query : {};
                for (let key in query) {
                    if (typeof query[key] !== 'object') {
                        q += "&"+key+"="+query[key];
                    }
                }
                url = url+q;

                this.$http.get(url).then((response) => {
                    let items = response.body;
                    const total = response.body.data.total ? response.body.data.total : response.body.total;

                    resolve({items, total});
                });

            });
        },

        postAPI (url, query) {
            return new Promise((resolve, reject) => {
                this.$http.post(url, query).then((response) => {
                    let items = response.body;
                    const total = response.body.total ? response.body.total : response.body.length;

                    resolve({items, total});
                })

            });
        },

        serialize (obj, prefix) {
            var str = [], p;
            for (p in obj) {
                if (obj.hasOwnProperty(p)) {
                    var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
                    str.push((v !== null && typeof v === "object") ?
                    this.serialize(v, k) :
                    encodeURIComponent(k) + "=" + encodeURIComponent(v));
                }
            }
            return str.join("&");
        },

        apiTest () {
            return "GET";
        }
    }
};
