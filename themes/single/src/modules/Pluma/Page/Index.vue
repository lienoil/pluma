<template>
  <section>
    <v-toolbar dark color="primary" class="sticky elevation-1">
      <v-toolbar-title>{{ trans("All Pages") }}</v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- Bulk Commands -->
      <v-slide-y-transition mode="out-in">
        <template v-if="dataset.bulk.model">
          <v-tooltip bottom>
            <v-btn v-can="{code: 'pages.trashed'}" slot="activator" icon ripple @click="destroy('false', dataset.selected)"><v-icon>delete_sweep</v-icon></v-btn>
            <span>{{ trans("Move selected to trash") }}</span>
          </v-tooltip>
          <hr class="vertical-divider">
        </template>
      </v-slide-y-transition>
      <v-tooltip bottom>
        <v-btn v-can="{code: 'pages.update'}" slot="activator" icon ripple @click="dataset.bulk.model = !dataset.bulk.model"><v-icon :color="dataset.bulk.model ? 'accent': ''">check_circle</v-icon></v-btn>
        <span>{{ trans("Toggle bulk commands") }}</span>
      </v-tooltip>
      <!-- Bulk Commands -->

      <!-- <v-tooltip bottom>
        <v-btn v-can="{code: 'pages.create'}" slot="activator" icon :to="{name: 'pages.create'}"><v-icon>note_add</v-icon></v-btn>
        <span>{{ trans("Create new page") }}</span>
      </v-tooltip> -->
      <v-tooltip bottom>
        <v-btn v-can="{code: 'pages.trashed'}" slot="activator" icon :to="{name: 'pages.trashed'}"><v-icon>archive</v-icon></v-btn>
        <span>{{ trans("View trashed pages") }}</span>
      </v-tooltip>

      <v-btn color="secondary" v-can="{code: 'pages.create'}" exact :to="{name: 'pages.create'}">{{ trans('Create Page') }}</v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
      <v-layout row wrap>
        <v-flex xs12 sm12>

          <page-empty-state v-if="dataset.empty"></page-empty-state>

          <v-card v-else>
            <v-data-table
              :headers="dataset.headers"
              :items="dataset.items"
              :search="dataset.search.query"
              :pagination.sync="dataset.pagination"
              :total-items="dataset.pagination.totalItems"
              :loading="dataset.loading"
              item-key="id"
              :no-data-text="trans('No pages found')"
              v-bind="dataset.bulk.model ? {'select-all':'accent'} : []"
              v-model="dataset.selected"
            >
              <v-progress-linear slot="progress" color="accent" indeterminate></v-progress-linear>

              <template slot="items" slot-scope="props">
                <tr :active="props.selected" @click="(dataset.bulk.model ? props.selected = ! props.selected : null)">
                  <td v-if="dataset.bulk.model"><v-checkbox hide-details :input-value="props.selected"></v-checkbox></td>
                  <td class="text-xs-center"><v-avatar color="transparent" size="35px"><img v-if="props.item.feature" :src="props.item.feature"></v-avatar></td>
                  <td><router-link exact :to="{name: 'pages.edit', params: {page: props.item.id}}"><strong v-html="props.item.title"></strong></router-link></td>
                  <td v-html="props.item.author"></td>
                  <td v-html="props.item.template"></td>
                  <td v-html="props.item.created"></td>
                  <td v-html="props.item.modified"></td>
                  <td class="text-xs-center">
                    <v-tooltip bottom>
                      <v-btn v-can="{code: 'pages.show'}" small icon slot="activator" exact :to="{name: 'pages.show', params: {page: props.item.id}}"><v-icon small>search</v-icon></v-btn>
                      <span>{{ trans('Preview page') }}</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                      <v-btn v-can="{code: 'pages.edit'}" small icon slot="activator" exact :to="{name: 'pages.edit', params: {page: props.item.id}}"><v-icon small>edit</v-icon></v-btn>
                      <span>{{ trans('Edit page') }}</span>
                    </v-tooltip>
                    <v-tooltip bottom>
                      <v-btn v-can="{code: 'pages.destroy'}" small icon slot="activator" exact :to="{name: 'pages.destroy', params: {page: props.item.id}}"><v-icon small>delete</v-icon></v-btn>
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
  </section>
</template>

<script>
import PageEmptyState from './partials/PageEmptyState.vue'

export default {
  components: {
    PageEmptyState
  },
  data () {
    return {
      dataset: {
        bulk: {
          model: false
        },
        empty: true,
        loading: true,
        filtered: false,
        headers: [
          { text: this.$root.trans('Featured Image'), align: 'left', value: 'feature' },
          { text: this.$root.trans('Title'), align: 'left', value: 'title' },
          { text: this.$root.trans('Author'), align: 'left', value: 'user_id' },
          { text: this.$root.trans('Template'), align: 'left', value: 'template' },
          { text: this.$root.trans('Created'), align: 'left', value: 'created_at' },
          { text: this.$root.trans('Modified'), align: 'left', value: 'updated_at' },
          { text: this.$root.trans('Actions'), align: 'center', sortable: false }
        ],
        items: [],
        pagination: {
          sortBy: 'id',
          totalItems: 0,
          rowsPerPage: 10 // this.$root.localstorage('single._.dataset.pagination.rowsPerPage', 25)
        },
        search: {
          query: ''
        },
        selected: []
      }
    }
  },
  watch: {
    // 'dataset.items': function (items) {
    //   this.dataset.empty = items.length === 0
    // },
    'dataset.pagination': {
      handler () {
        this.all()
      },
      deep: true
    },

    'dataset.pagination.rowsPerPage': function (value) {
      this.$root.localstorage({'single._.dataset.pagination.rowsPerPage': value})
    },

    'dataset.search.query': function (filter) {
      let self = this

      if (filter.length >= 3) {
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
    this.all()
  }
}
</script>
