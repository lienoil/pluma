<template>
  <v-slide-y-transition>
    <v-card>
      <!-- <v-text-field
        append-icon="search"git s
        hide-details
        label="Search"
        single-line
        v-model="dataset.searchTable"
        clearable
        clear-icon="cancel"
      ></v-text-field> -->
      <v-data-table
        :headers="dataset.headers"
        :items="dataset.items"
        :search="dataset.searchTable"
        item-key="title"
        :select-all="dataset.bulkdestroy"
        v-model="dataset.selected"
        >
        <template slot="headerCell" slot-scope="props">
          <v-tooltip bottom>
            <span slot="activator">
              {{ trans(props.header.text) }}
            </span>
            <span>
              {{ trans(props.header.text) }}
            </span>
          </v-tooltip>
        </template>
        <template
          slot="items"
          slot-scope="props"
          >
          <template v-if="dataset.bulkdestroy">
            <td>
              <v-checkbox
                v-model="props.selected"
                accent
                color="accent"
                hide-details
              ></v-checkbox>
            </td>
          </template>
          <td v-html="props.item.id"></td>
          <td>
            <v-avatar size="36px">
              <img :src="props.item.thumbnail">
            </v-avatar>
          </td>
          <td class="table--ellipsis">
            <v-tooltip
              max-width="300px"
              bottom
              transition="scale-transition"
              >
              <a
                href=""
                v-html="trans(props.item.title)"
                slot="activator"
                >
              </a>
              <span v-html="trans(props.item.title)"></span>
            </v-tooltip>
          </td>
          <td v-html="trans(props.item.category)"></td>
          <td v-html="trans(props.item.timestamp)"></td>
          <td v-html="trans(props.item.part)"></td>
          <td v-html="trans(props.item.status)"></td>
          <td class="layout mx-0 justify-center">
            <v-tooltip bottom>
              <v-btn slot="activator" icon @click="">
                <v-icon
                  small
                  class="mx-3"
                  >
                  edit
                </v-icon>
              </v-btn>
              <span>{{ trans('Edit') }}</span>
            </v-tooltip>
            <v-tooltip bottom>
              <v-btn slot="activator" icon @click="">
                <v-icon
                  small
                  class="mx-3"
                  >
                  delete
                </v-icon>
              </v-btn>
              <span>{{ trans('Move to trash') }}</span>
            </v-tooltip>
          </td>
        </template>
        <v-card
          flat
          :value="true"
          slot="no-results"
          class="text-xs-center"
          >
          <v-card-text>
            <data-table-icon
              width="120"
              height="120"
              class="mb-3"
              >
            </data-table-icon>
            <div class="grey--text">
              Your search for
              "{{ dataset.searchTable }}"
              found no results.
            </div>
          </v-card-text>
        </v-card>
      </v-data-table>
    </v-card>
  </v-slide-y-transition>
</template>

<script>
import DataTableIcon from '@/components/Icons/DataTableIcon'
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,

  name: 'DataTable',

  props: {
    width: {
      type: [Number, String],
      default: 120
    },
    height: {
      type: [Number, String],
      default: 120
    },
    items: {
      type: [Object, Array],
      default: () => {
        return {
        }
      }
    }
  },

  data () {
    return {
      dataset: {},
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.datatable, this.items)
  },

  components: {
    DataTableIcon,
  },

  computed: {
    ...mapGetters({
      datatable: 'datatable/datatable'
    })
  },
  methods: {
    show () {
      this.$store.dispatch('datatable/PROMPT_DIALOG', { model: true })
    },

    hide () {
      this.$store.dispatch('datatable/PROMPT_DIALOG', { model: false })
    },
  }
}
</script>
