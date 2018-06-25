<template>
  <div>
    <v-slide-y-transition>
      <v-data-table
        :headers="dataset.headers"
        :item-key="itemKey"
        :items="dataset.items"
        :total-items="dataset.pagination.totalItems"
        :rows-per-page-items="rowsPerPageItems"
        :rows-per-page-text="rowsPerPageText"
        :pagination.sync="dataset.pagination"
        class="elevation-1"
        v-bind="selectAll?{'select-all':'primary'}:null"
        v-model="dataset.selected"
        v-show="table"
      >
        <template slot="header" scope="prop">
          <slot name="header" :prop="prop"></slot>
        </template>
        <template slot="items" scope="prop">
          <!-- <span v-html="prop.selected"></span> -->
          <slot name="items" :prop="prop">
            <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
              <td v-if="selectAll">
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
        <v-layout row wrap v-if="(paginationTop || paginationBoth) && pages > 1">
          <v-flex sm12 class="text-xs-center">
            <v-pagination :circle="paginationCircle" v-model="dataset.pagination.page" :length="pages"></v-pagination>
          </v-flex>
        </v-layout>
        <v-layout row wrap style="min-height: 200px">
          <!-- <v-spacer></v-spacer> -->
          <v-flex xs12 sm6 md3 v-for="(item, i) in dataset.items" :key="i">
            <v-card class="elevation-1">
              <slot name="card" :prop="{item, index: i, selected: computedSelected }">
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
          <!-- <v-spacer></v-spacer> -->
        </v-layout>
        <slot name="pagination" :prop="{pagination: dataset.pagination}">
          <v-layout row wrap v-if="(!paginationTop || paginationBoth) && pages > 1">
            <v-flex sm12 class="text-xs-center">
              <v-pagination :circle="paginationCircle" v-model="dataset.pagination.page" :length="pages"></v-pagination>
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
      rowsPerPageItems: { type: Array, default: () => { return [5, 10, 25, { text: "All", value: -1 }] } },
      rowsPerPageText: { type: String, default: 'No resource found' },
      pagination: { type: Object, default: () => { return { rowsPerPage: 10, page: 1, totalItems: 0 } } },
      paginationTop: { type: Boolean, default: false },
      paginationBoth: { type: Boolean, default: false },
      paginationCircle: { type: Boolean, default: false },
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
          selected: [],
          pagination: {},
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
            self.dataset.items = self.items
            self.dataset.pagination = self.pagination
            self.dataset.pagination.totalItems = self.totalItems
            // self.dataset.selected = self.selected
            self.dataset.headers = self.headers
          },

          select (item, i) {
            item.active = !item.active
            if (item.active) {
              self.dataset.selected.push(item)
              return true
            } else {
              let index = self.dataset.selected.indexOf(i)
              self.dataset.selected.splice(index, 1)
              return false
            }
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
        this.$set(this.dataset, 'pagination', val)
      },
      'dataset.pagination': function (val) {
        // console.log('pag', this.dataset.pagination)
        this.$emit('pagination', val)
      },
      'pagination.descending': function (val) {
        this.dataset.pagination = this.pagination
        this.$emit('pagination', this.dataset.pagination)
      },
      'pagination.sortBy': function (val) {
        this.dataset.pagination = this.pagination
        this.$emit('pagination', this.dataset.pagination)
      },
      'pagination.rowsPerPage': function (val) {
        // alert('pagination.rowsPerPage')
        // console.log('pagrowsPer', val)
        this.dataset.pagination = this.pagination
        let index = this.rowsPerPageItems.findIndex(i => {
          if (typeof i.value != 'undefined') {
            return i.value == val
          } else {
            return i == val
          }
        })
        this.dataset.pagination.rowsPerPageText = typeof this.rowsPerPageItems[index].text != 'undefined' ? this.rowsPerPageItems[index].text : this.rowsPerPageItems[index]
        this.$emit('pagination', this.dataset.pagination)
      },
      'dataset.pagination.page': function (val) {
        // this.dataset.pagination = this.pagination
        this.$emit('pagination', this.dataset.pagination)
      },
      'selected': function (value) {
        this.dataset.selected = value
      },
      'dataset.selected': function (value) {
        this.$emit('input', value)
      },
      'card': function (value) {
        if (this.infinite) {
          let infiniteLoading = this.$refs.infiniteLoading
          infiniteLoading.$emit('$InfiniteLoading:reset')
          this.$emit('change', {infiniteLoading, value})
        }
      },
      'totalItems': function (value) {
        this.dataset.pagination.totalItems = value
      }
    },
    computed: {
      pages () {
        return this.dataset.pagination.rowsPerPage ? Math.ceil(this.dataset.pagination.totalItems / this.dataset.pagination.rowsPerPage) : 0
      },

      computedSelected () {
        let selected = {}
        this.dataset.selected.forEach(i => {
          selected[i[this.itemKey]] = true
        })
        return typeof selected[this.itemKey] != 'undefined'
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
