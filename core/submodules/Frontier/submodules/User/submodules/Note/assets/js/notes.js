const BASE_URL = window.location.origin;

Vue.use(VueResource);

mixins.push({
  data () {
    return {
      resources: {
        items: [],
        errors: [],
        url: {
          notes: {
            api: {
              all: BASE_URL + '/api/v1/notes/all',
            },
          },
        },
      },
    };
  },
  methods: {
    get () {
      let query = {
        descending: 'false',
        page: 1,
        sort: 'id',
        take: 1,
      }

      this.api().get(this.resources.url.notes.api.all, query)
        .then(data => {
          this.resources.items = data.items.data;
        });
    },

    remove (items, id) {
      items.splice(id, 1);
    }
  },
  mounted () {
    this.get();
  },
});
