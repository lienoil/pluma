<template>
  <div>
    <v-toolbar dark color="secondary" class="sticky elevation-1">
      <v-icon left>find_in_page</v-icon>
      <v-toolbar-title>All Page</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-slide-y-reverse-transition>
        <template v-if="! dataset.bulk.model">
          <v-tooltip bottom>
            <v-btn slot="activator" icon :to="{name: 'pages.create'}"><v-icon>note_add</v-icon></v-btn>
            <span>Create new page</span>
          </v-tooltip>
        </template>
      </v-slide-y-reverse-transition>

      <v-slide-y-reverse-transition>
        <template v-if="! dataset.bulk.model">
          <v-tooltip bottom>
            <v-btn slot="activator" icon :to="{name: 'pages.trashed'}"><v-icon>archive</v-icon></v-btn>
            <span>View trashed pages</span>
          </v-tooltip>
        </template>
      </v-slide-y-reverse-transition>

      <!-- Bulk Commands -->
      <v-slide-y-transition mode="out-in">
        <template v-if="dataset.bulk.model">
          <v-tooltip bottom>
            <v-btn slot="activator" icon ripple @click="destroy('false', dataset.selected)"><v-icon>delete_sweep</v-icon></v-btn>
            <span>Move selected to trash</span>
          </v-tooltip>
        </template>
      </v-slide-y-transition>
      <v-tooltip bottom>
        <v-btn slot="activator" icon ripple @click="dataset.bulk.model = ! dataset.bulk.model"><v-icon :color="dataset.bulk.model ? 'accent': ''">check_circle</v-icon></v-btn>
        <span>Toggle bulk commands</span>
      </v-tooltip>
      <!-- Bulk Commands -->

    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12 sm12>
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
              <v-btn v-if="dataset.filtered" flat @click="all"><v-icon left>close</v-icon>Remove Filter</v-btn>
            </v-toolbar>

            <v-data-table
              :headers="dataset.headers"
              :items="dataset.items"
              :search="dataset.search.query"
              :pagination.sync="dataset.pagination"
              :total-items="dataset.pagination.totalItems"
              :loading="dataset.loading"
              item-key="id"
              no-data-text="No pages found"
              v-bind="dataset.bulk.model ? {'select-all':'accent'} : []"
              v-model="dataset.selected"
            >
              <v-progress-linear slot="progress" color="accent" indeterminate></v-progress-linear>

              <template slot="items" slot-scope="props">
                <tr :active="props.selected" @click="(dataset.bulk.model ? props.selected = ! props.selected : null)">
                  <td v-if="dataset.bulk.model"><v-checkbox hide-details :input-value="props.selected"></v-checkbox></td>
                  <td class="text-xs-center"><v-avatar color="grey lighten-1" size="35px"><img v-if="props.item.feature" :src="props.item.feature"></v-avatar></td>
                  <td><router-link exact :to="{name: 'pages.edit', params: {page: props.item.id}}"><strong v-html="props.item.title"></strong></router-link></td>
                  <td>
                    <v-avatar size="25px"><img :src="props.item.authoravatar"></v-avatar>
                    <a @click="filter({user_id: props.item.user_id})" v-html="props.item.author"></a>
                  </td>
                  <td><a @click="filter({template: props.item.template})" v-html="props.item.template"></a></td>
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
                        <v-list-tile :ripple="{color: 'primary'}" exact @click="destroy(props.item.id)">
                          <v-list-tile-action>
                            <v-icon color="warning">delete</v-icon>
                          </v-list-tile-action>
                          <v-list-tile-content>
                            <v-list-tile-title>Move to Trash</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                      </v-list>
                    </v-menu>
                  </td>
                </tr>
              </template>
            </v-data-table>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {
  data () {
    return {
      dataset: {
        bulk: {
          model: false
        },
        loading: true,
        filtered: false,
        headers: [
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
          sortBy: 'id',
          totalItems: 0
        },
        search: {
          query: ''
        },
        selected: []
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
              self.dataset.filtered = false
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
          this.dataset.filtered = false
        })
    },
    destroy (id, params) {
      if (typeof params !== 'undefined' && !params.length) {
        this.$root.alert({color: 'secondary', type: 'warning', text: `Please select items to move to trash`})
        return
      }

      if (params) {
        params = { id: params.map(item => { return item.id }) }
      }

      this.$http.delete('/api/v1/pages/' + id + '/destroy', { params: params })
        .then(response => {
          if (response.status === 200) {
            this.all()
            this.dataset.selected = []
            if (typeof params !== 'undefined') {
              this.$root.alert({color: 'secondary', type: 'success', text: `${params.length} ${params.length === 1 ? 'page' : 'pages'} moved to trash.`})
            } else {
              this.$root.alert({color: 'secondary', type: 'success', text: `Page moved to trash.`})
            }
          }
        })
        .catch(error => {
          this.$root.alert({color: 'secondary', type: 'error', text: `Oops! Something went wrong. ${error.response.data}`})
        })
    },
    filter (filter) {
      const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination
      let query = Object.assign({
        descending: descending,
        page: page,
        sort: sortBy,
        take: rowsPerPage
      }, filter)

      this.dataset.loading = true
      this.$http.get('/api/v1/pages/all', {params: query})
        .then(response => {
          this.dataset.items = response.data.data
          // this.dataset.pagination.totalItems = response.data.total
          this.dataset.loading = false
          this.dataset.filtered = true
        })
    }
  },
  mounted () {
    // this.all()
  }
}
</script>

<style>
  /*TODO: add to global css*/
  .font-size-5 {
    zoom: 1.5;
    -moz-transform: scale(1.5);
    -moz-transform-origin: 0 0;
  }
  .font-size-4 {
    zoom: 1.4;
    -moz-transform: scale(1.4);
    -moz-transform-origin: 0 0;
  }
  .font-size-3 {
    zoom: 1.3;
    -moz-transform: scale(1.3);
    -moz-transform-origin: 0 0;
  }
  .font-size-2 {
    zoom: 1.2;
    -moz-transform: scale(1.2);
    -moz-transform-origin: 0 0;
  }
  .font-size-1 {
    zoom: 1;
    -moz-transform: scale(1.1);
    -moz-transform-origin: 0 0;
  }
  .font-size--1 {
    zoom: 0.9;
    -moz-transform: scale(0.9);
    -moz-transform-origin: 0 0;
  }
</style>
