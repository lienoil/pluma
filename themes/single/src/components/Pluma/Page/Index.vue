<template>
  <v-container fluid class="pa-0">
    <v-toolbar dark color="secondary" class="elevation-1">
      <v-icon left>find_in_page</v-icon>
      <v-toolbar-title>All Page</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-tooltip left>
        <v-btn slot="activator" icon :to="{name: 'pages.create'}"><v-icon>note_add</v-icon></v-btn>
        <span>Add new page</span>
      </v-tooltip>
    </v-toolbar>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm12>
        <v-card>
          <v-toolbar color="primary" card dark>
            <v-text-field
              prepend-icon="search"
              label="Search"
              solo-inverted
              class="mx-2"
              clearable
              v-model="dataset.search.query"
              flat
            ></v-text-field>
          </v-toolbar>

          <v-data-table
            :headers="dataset.headers"
            :items="dataset.items"
            :search="dataset.search.query"
            :pagination.sync="dataset.pagination"
            :total-items="dataset.pagination.totalItems"
            :loading="dataset.loading"
            no-data-text="No pages found"
          >
            <v-progress-linear v-if="dataset.loading" slot="progress" color="primary" indeterminate></v-progress-linear>
            <template slot="items" slot-scope="props">
              <td class="text-xs-center"><v-avatar color="grey lighten-1" size="30px"><img v-if="props.item.feature" :src="props.item.feature"></v-avatar></td>
              <td><router-link exact :to="{name: 'pages.edit', params: {page: props.item.id}}"><strong v-html="props.item.title"></strong></router-link></td>
              <td><a v-html="props.item.author"></a></td>
              <td v-html="props.item.template"></td>
              <td v-html="props.item.created"></td>
              <td v-html="props.item.modified"></td>
              <td class="text-xs-center">
                <v-menu bottom left>
                  <v-btn icon slot="activator">
                    <v-icon>more_vert</v-icon>
                  </v-btn>
                  <v-list dense>
                    <v-list-tile ripple exact :to="{name: 'pages.show', params: {page: props.item.id}}">
                      <v-list-tile-action>
                        <v-icon color="info">search</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>Preview Page</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile ripple exact :to="{name: 'pages.edit', params: {page: props.item.id}}">
                      <v-list-tile-action>
                        <v-icon color="success">edit</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>Edit Page</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile>
                    <!-- <v-list-tile ripple exact :to="{name: 'pages.destroy', params: {page: props.item.id}}">
                      <v-list-tile-action>
                        <v-icon color="warning">delete</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                        <v-list-tile-title>Move to Trash</v-list-tile-title>
                      </v-list-tile-content>
                    </v-list-tile> -->
                  </v-list>
                </v-menu>
              </td>
            </template>
          </v-data-table>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
  </v-container>
</template>

<script>
export default {
  data () {
    return {
      dataset: {
        loading: true,
        headers: [
          { text: 'ID', align: 'left', value: 'id', visible: false },
          { text: 'Featured Image', align: 'left', value: 'feature' },
          { text: 'Title', align: 'left', value: 'title' },
          { text: 'Author', align: 'left', value: 'user_id' },
          { text: 'Template', align: 'left', value: 'template' },
          { text: 'Created', align: 'left', value: 'created_at' },
          { text: 'Modified', align: 'left', value: 'updated_at' },
          { text: 'Actions', align: 'center', sortable: false }
        ],
        items: [],
        pagination: {
          totalItems: 0
        },
        search: {
          query: ''
        }
      }
    }
  },
  watch: {
    'dataset.pagination': {
      handler () {
        this.all()
      },
      deep: true
    },

    'dataset.search.query': function (filter) {
      let self = this

      if (filter.length >= 2) {
        setTimeout(function () {
          const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination

          let query = {
            descending: descending,
            page: page,
            search: filter,
            sort: sortBy,
            take: rowsPerPage
          }

          self.$http.get('/api/v1/pages/all', {params: query})
            .then(response => {
              self.dataset.items = response.data.data
              self.dataset.pagination.totalItems = response.data.total
              self.dataset.loading = false
            })
        }, 900)
      }
    }
  },
  methods: {
    all () {
      const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination
      let query = {
        descending: descending,
        page: page,
        sort: sortBy,
        take: rowsPerPage,
        search: this.dataset.search.query
      }

      this.dataset.loading = true
      this.$http.get('/api/v1/pages/all', {params: query})
        .then(response => {
          this.dataset.items = response.data.data
          this.dataset.pagination.totalItems = response.data.total
          this.dataset.loading = false
        })
    }
  },
  mounted () {
    // this.all()
  }
}
</script>
