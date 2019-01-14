<template>
  <section>
    <template v-if="dataset.loaded">
      <toolbar-menu :items="toolbar"></toolbar-menu>
      <v-container fluid grid-list-lg>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card flat class="mb-3">
              <v-data-table
                v-model="resource.selected"
                :headers="resource.headers"
                :items="resource.items"
                :pagination.sync="resource.pagination"
                select-all
                item-key="title"
                class="elevation-1"
                >
                <template slot="headerCell" slot-scope="props">
                  <span>
                    {{ trans(props.header.text) }}
                  </span>
                </template>
                <template slot="items" slot-scope="props">
                  <tr :active="props.selected" @click="props.selected = !props.selected">
                    <td>
                      <v-checkbox
                        :input-value="props.selected"
                        primary
                        hide-details
                      ></v-checkbox>
                    </td>
                    <td v-html="props.item.id"></td>
                    <td class="table--ellipsis">
                      <v-tooltip
                        max-width="300"
                        bottom
                        >
                        <span slot="activator" v-html="trans(props.item.title)"></span>
                        <span v-html="trans(props.item.title)"></span>
                      </v-tooltip>
                    </td>
                    <td v-html="props.item.author"></td>
                    <td v-html="props.item.categoryname"></td>
                    <td v-html="props.item.created"></td>
                    <td v-html="props.item.modified"></td>
                    <td class="layout mx-0 justify-center">
                      <v-tooltip bottom>
                        <v-btn
                          slot="activator"
                          icon
                          :to="{
                            name: 'announcements.show',
                            params: {
                              code: props.item.code,
                              meta: { item: props.item }
                            },
                          }"
                          >
                          <v-icon
                            small
                            class="mx-3"
                            >
                            mdi-open-in-new
                          </v-icon>
                        </v-btn>
                        <span>{{ trans('View Details') }}</span>
                      </v-tooltip>
                      <v-tooltip bottom>
                        <v-btn
                          slot="activator"
                          icon
                          :to="{
                            name: 'announcements.edit',
                            params: {
                              code: props.item.code,
                              meta: { item: props.item }
                            },
                          }"
                          >
                          <v-icon
                            small
                            class="mx-3"
                            >
                            mdi-circle-edit-outline
                          </v-icon>
                        </v-btn>
                        <span>{{ trans('Edit') }}</span>
                      </v-tooltip>
                      <v-tooltip bottom>
                        <v-btn slot="activator" icon>
                          <v-icon
                            small
                            class="mx-3"
                            >
                            mdi-delete-outline
                          </v-icon>
                        </v-btn>
                        <span>
                          {{ trans('Move to Archive') }}
                        </span>
                      </v-tooltip>
                    </td>
                  </tr>
                </template>
              </v-data-table>
            </v-card>

            <v-card flat class="mb-3">
              <!-- <data-table :items="resource"></data-table> -->
            </v-card>

            <v-card flat class="mb-3">
              <!-- <data-table :items="resource"></data-table> -->
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </template>

    <template v-else>
      <v-card flat class="transparent">
        <v-card-text>
          <empty-state></empty-state>
        </v-card-text>
      </v-card>
    </template>
  </section>
</template>

<script>
import store from '@/store'
// import axios from 'axios'
import EmptyState from './partials/EmptyState'

export default {
  store,

  name: 'Index',

  components: {
    EmptyState
  },

  // created () {
  //   axios.get('/api/v1/announcements/all').then(response => {
  //     this.resource.items = response.data.data
  //   })
  // },

  data () {
    return {
      dataset: {
        loaded: true,
      },
      bulk: {
        destroy: {
          model: false,
        },
      },
      toolbar: {
        title: 'All Announcements',
        listGridView: false,
        createBtn: {
          name: 'announcements.create',
        },
        archivedBtn: {
          name: 'announcements.archived',
        },
      },
      resource: {
        items: [],
        data: null,
        pagination: {
          sortBy: 'title'
        },
        headers: [
          { text: 'ID', align: 'left', value: 'id' },
          { text: 'Title', align: 'left', value: 'title' },
          { text: 'Author', align: 'left', value: 'user_id' },
          { text: 'Category', align: 'left', value: 'category_at' },
          { text: 'Created', align: 'left', value: 'created_at' },
          { text: 'Modified', align: 'left', value: 'updated_at' },
          { text: 'Actions', align: 'center', sortable: false },
        ],
      },
    }
  },
}
</script>
