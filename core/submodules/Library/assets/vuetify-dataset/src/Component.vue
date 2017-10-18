<template>
  <div>
    <v-slide-y-transition>
      <v-data-table
        :headers="dataset.headers"
        :item-key="itemKey"
        :items="dataset.items"
        :total-items="dataset.pagination.totalItems"
        v-bind:pagination.sync="dataset.pagination"
        class="elevation-1"
        v-bind="{'select-all': selectAll}"
        v-model="dataset.selected"
        v-show="table"
      >
        <template slot="header" scope="prop">
          <slot name="header" :prop="prop"></slot>
        </template>
        <template slot="items" scope="prop">
          <slot name="items" :prop="prop">
            <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
              <td>
                <v-checkbox
                  color="primary"
                  primary
                  hide-details
                  :input-value="prop.selected"
                ></v-checkbox>
              </td>
              <td v-html="prop.item[itemValue]"></td>
              <td v-html="prop.item[itemKey]"></td>
            </tr>
          </slot>
        </template>
      </v-data-table>
    </v-slide-y-transition>

    <v-scale-transition>
      <div v-show="card">
        <v-layout row wrap style="min-height: 200px">
          <v-flex sm3 v-for="(item, i) in dataset.items" :key="i">
            <v-card class="elevation-1 mb-3">
              <slot name="card" :prop="item">
                <v-card-media v-if="item.thumbnail" :src="item.thumbnail" height="250"></v-card-media>
                <v-card-text v-html="item.name"></v-card-text>
              </slot>
            </v-card>
          </v-flex>
          <infinite-loading v-if="infinite" spinner="waveDots" @infinite="listen" ref="infiniteLoading">
            <template slot="no-more" class="text-xs-center">
              <slot name="no-more">
                <div>No more resource found.</div>
              </slot>
            </template>
          </infinite-loading>
        </v-layout>
        <slot name="pagination" :prop="{pagination: dataset.pagination}">
          <v-layout row wrap>
            <v-flex sm12 class="text-xs-center">
              <v-pagination circle v-model="dataset.pagination.page" :length="pages"></v-pagination>
            </v-flex>
          </v-layout>
        </slot>
      </div>
    </v-scale-transition>
  </div>
</template>

<script>
  import InfiniteLoading from 'vue-infinite-loading'

  export default {
    name: 'v-dataset',
    components: { InfiniteLoading },
    model: {
      prop: 'selected'
    },
    props: {
      card: { type: Boolean, default: true },
      infinite: { type: Boolean, default: false },
      headers: { type: Array, default: () => { return [] } },
      itemKey: { type: String, default: 'name' },
      items: { type: Array, default: () => { return [] } },
      itemValue: { type: String, default: 'id' },
      pagination: { type: Object, default: () => { return {} } },
      selectAll: { type: String, default: undefined },
      selected: { type: Array, default: () => { return [] } },
      table: { type: Boolean, default: false },
      totalItems: { type: Number, default: 0 },
    },
    data () {
      return {
        number: 100,
        dataset: {
          headers: [],
          items: [],
          pagination: {
            totalItems: 0,
            rowsPerPage: 10
          },
        }
      }
    },

    mounted () {
      this.datasetbox().mount()
    },

    methods: {
      datasetbox () {
        let self = this

        return {
          mount () {
            // console.log('entry', self.items)
            self.dataset.items = self.items
            self.dataset.pagination = Object.assign(self.dataset.pagination, self.pagination)
            self.dataset.pagination.totalItems = self.totalItems
            self.dataset.selected = self.selected
            self.dataset.headers = self.headers
          }
        }
      },

      listen ($state) {
        let self = this
        self.$emit('infinite', $state)
      },

      infinitebox () {
        let self = this

        return {
          mount () {
            //
          },
        }
      }
    },

    watch: {
      'items': function (value) {
        this.dataset.items = value
        this.$emit('items', value)
      },
      'pagination': function (val) {
        this.dataset.pagination = Object.assign(this.pagination, val)
      },
      'dataset.pagination': function (val) {
        this.$emit('pagination', val)
      },
      'dataset.pagination.page': function (val) {
        this.$emit('pagination', this.dataset.pagination)
      },
      'selected': function (value) {
        this.dataset.selected = value
        this.$emit('input', value)
      },
      'dataset.selected': function (value) {
        this.$emit('selected', value)
      },
      'card': function (value) {
        let infiniteLoading = this.$refs.infiniteLoading
        infiniteLoading.$emit('$InfiniteLoading:reset')
        this.$emit('change', {infiniteLoading, value})
      },
      'totalItems': function (value) {
        this.dataset.pagination.totalItems = value
      }
    },
    computed: {
      pages () {
        return this.dataset.pagination.rowsPerPage ? Math.ceil(this.dataset.pagination.totalItems / this.dataset.pagination.rowsPerPage) : 0

      }
    }
  }
</script>

<style lang="scss" scoped>
  .infinite-loading-container {
    display: block;
    width: 100%;
  }
</style>
