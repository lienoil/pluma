const BASE_URL = window.location.origin;

Vue.use(VueResource);

mixins.push({
  data () {
    return {
      test: false,
      baseurl: window.location.origin,
      dataset: {
        items: [],
      },
      pages: {
        items: [],
      },
      url: {
        page: {
          api: {
            all: BASE_URL + '/api/v1/pages/all',
          },
          admin: {
            edit: BASE_URL + '/admin/pages/null/edit',
          },
        },
        user: {
          api: {
            all: BASE_URL + '/api/v1/users/all',
            search: BASE_URL + '/api/v1/users/search',
            update: BASE_URL + '/api/v1/users/null/update',
          },
          admin: {
            edit: BASE_URL + '/admin/users/null/edit',
          },
          public: {
            //
          },
        }
      }
    }
  },
  methods: {

  },
  mounted () {
    this.api().get(this.url.user.api.all).then(data => {
      this.dataset.items = data.items.data;
    });

    this.api().get(this.url.page.api.all).then(data => {
      this.page.items = data.items.data;
    });
  }
})
