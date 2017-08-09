Vue.mixin({
    methods: {
        api: {
            search (url, query) {
                return new Promise((resolve, reject) => {
                    let q = "";
                    query = query ? query : {};
                    for (key in query) {
                        q += "&"+key+"="+query[key];
                    }
                    url = url+'?take='+(rowsPerPage)+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending)+q;

                    this.$http.get(url).then((response) => {
                        let items = response.body;
                        const total = response.body.total ? response.body.total : response.body.length;

                        resolve({items, total});
                    })

                });
            },

            get (url, query) {
                return new Promise((resolve, reject) => {
                    let q = "?d="+ new Date();
                    query = query ? query : {};
                    for (key in query) {
                        q += "&"+key+"="+query[key];
                    }
                    url = url+q;

                    this.$http.get(url).then((response) => {
                        let items = response.body;
                        const total = response.body.total ? response.body.total : response.body.length;

                        resolve({items, total});
                    });

                });
            },

            post (url, query) {
                return new Promise((resolve, reject) => {
                    this.$http.post(url, query).then((response) => {
                        let items = response.body;
                        const total = response.body.total ? response.body.total : response.body.length;

                        resolve({items, total});
                    })

                });
            }
        }
    }
});
