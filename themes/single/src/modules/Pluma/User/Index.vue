<template>
  <div>
    <v-toolbar dark xcolor="primary" class="primary sticky elevation-1">
      <v-toolbar-title>{{ trans('All Accounts') }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- Bulk Commands -->
      <v-slide-y-transition mode="out-in">
        <template v-if="dataset.bulk.model">
          <v-tooltip bottom>
            <v-btn slot="activator" icon ripple @click="destroy('false', dataset.selected)"><v-icon>delete_sweep</v-icon></v-btn>
            <span>{{ trans('Move selected to trash') }}</span>
          </v-tooltip>
          <hr class="vertical-divider">
        </template>
      </v-slide-y-transition>
      <v-tooltip bottom>
        <v-btn slot="activator" icon ripple @click="dataset.bulk.model = !dataset.bulk.model"><v-icon :color="dataset.bulk.model ? 'accent': ''">check_circle</v-icon></v-btn>
        <span>{{ trans('Toggle bulk commands') }}</span>
      </v-tooltip>
      <!-- Bulk Commands -->

      <v-tooltip bottom>
        <v-btn slot="activator" icon :to="{name: 'users.trashed'}"><v-icon>archive</v-icon></v-btn>
        <span>{{ trans('View trashed users') }}</span>
      </v-tooltip>

      <v-divider class="vertical"></v-divider>

      <v-tooltip bottom>
        <v-btn slot="activator" color="secondary" :to="{name: 'users.create'}">{{ trans('Add Account') }}</v-btn>
        <span>{{ trans('Create new account') }}</span>
      </v-tooltip>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12 sm12>
          <v-card>
            <v-data-table
              :headers="dataset.headers"
              :items="dataset.items"
              :search="dataset.search.query"
              :pagination.sync="dataset.pagination"
              :total-items="dataset.pagination.totalItems"
              :loading="dataset.loading"
              item-key="id"
              :no-data-text="trans('No users found')"
              class="table__striped"
              v-bind="dataset.bulk.model ? {'select-all':'accent'} : []"
              v-model="dataset.selected"
            >
              <v-progress-linear slot="progress" color="accent" indeterminate></v-progress-linear>

              <template slot="items" slot-scope="props">
                <tr :active="props.selected" @click="(dataset.bulk.model ? props.selected = ! props.selected : null)">
                  <td v-if="dataset.bulk.model"><v-checkbox hide-details :input-value="props.selected"></v-checkbox></td>
                  <td><v-avatar color="transparent" size="35px" class="my-2 mr-2"><img v-if="props.item.photo" :src="props.item.photo"></v-avatar></td>
                  <td>
                    <router-link exact :to="{name: 'users.show', params: {user: props.item.id}}">
                      <v-tooltip bottom>
                        <strong slot="activator" v-html="props.item.fullname"></strong>
                        <span>{{ trans("Preview user details") }}</span>
                      </v-tooltip>
                    </router-link>
                  </td>
                  <td v-html="props.item.username"></td>
                  <td v-html="props.item.email"></td>
                  <td class="text-xs-right" v-html="props.item.created"></td>
                  <td class="text-xs-right" v-html="props.item.modified"></td>
                  <td class="layout mx-0 justify-center">
                    <v-tooltip bottom>
                      <v-btn icon slot="activator" exact :to="{name: 'users.edit', params: {user: props.item.id}}"><v-icon>edit</v-icon></v-btn>
                      <span>{{ trans('Edit user') }}</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                      <v-btn icon slot="activator" exact :to="{name: 'users.destroy', params: {user: props.item.id}}"><v-icon>delete</v-icon></v-btn>
                      <span>{{ trans('Move to trash') }}</span>
                    </v-tooltip>
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
          { text: this.trans('Avatar'), align: 'center', sortable: false },
          { text: this.trans('Name'), align: 'left', value: 'firstname' },
          { text: this.trans('Username'), align: 'left', value: 'username' },
          { text: this.trans('Email'), align: 'left', value: 'email' },
          { text: this.trans('Created'), align: 'right', value: 'created_at' },
          { text: this.trans('Modified'), align: 'right', value: 'updated_at' },
          { text: this.trans('Actions'), align: 'center', sortable: false }
        ],
        items: [],
        pagination: {
          sortBy: 'id',
          totalItems: 0,
          rowsPerPage: this.$root.localstorage('single._.dataset.pagination.rowsPerPage', 25)
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
        // this.all()
      },
      deep: true
    },

    'dataset.pagination.rowsPerPage': function (value) {
      this.$root.localstorage({'single._.dataset.pagination.rowsPerPage': value})
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

          self.$http.get('/api/v1/users/all', {params: query})
            .then(({data, status}) => {
              self.dataset.items = data.data
              self.dataset.pagination.totalItems = data.meta.total
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
      this.$http.get('/api/v1/users/all', {params: query})
        .then(({data, status}) => {
          this.dataset.items = data.data
          this.dataset.pagination.totalItems = data.meta.total
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

      this.$http.delete('/api/v1/users/' + id + '/destroy', { params: params })
        .then(response => {
          if (response.status === 200) {
            this.all()
            this.dataset.selected = []
            if (typeof params !== 'undefined') {
              this.$root.alert({color: 'secondary', type: 'success', text: `${params.length} ${params.length === 1 ? 'page' : 'pages'} moved to trash.`})
            } else {
              this.$root.alert({color: 'secondary', type: 'success', text: `User moved to trash.`})
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
      this.$http.get('/api/v1/users/all', {params: query})
        .then(response => {
          this.dataset.items = response.data.data
          // this.dataset.pagination.totalItems = response.data.total
          this.dataset.loading = false
          this.dataset.filtered = true
        })
    }
  },
  mounted () {
    this.all()
  }
}
</script>
