<template>
  <v-slide-y-transition>
    <v-card>
      <!-- <v-text-field
        append-icon="search"
        hide-details
        label="Search"
        single-line
        v-model="dataset.searchTable"
      ></v-text-field> -->
      <v-data-table
        :headers="dataset.headers"
        :items="dataset.items"
        :search="dataset.searchTable"
        item-key="title"
        :select-all="dataset.selectAll"
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
          <template v-if="dataset.bulkDestroy">
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
          <td class="text-xs-center">
            <v-tooltip bottom width="50">
              <v-btn slot="activator" icon @click="">
                <v-icon
                  small
                  class="mx-3"
                  >
                  edit
                </v-icon>
              </v-btn>
              <span>Edit</span>
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
              <span>Delete</span>
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
            <v-avatar size="160px">
              <img src="@/assets/logo.png" alt="">
            </v-avatar>
          </v-card-text>
          <v-card-text>
            Your search for
            "{{ dataset.searchTable }}"
            found no results.
          </v-card-text>
        </v-card>
      </v-data-table>
    </v-card>
  </v-slide-y-transition>
</template>

<script>
import AddMediaIcon from '@/components/Icons/AddMediaIcon'
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  AddMediaIcon,

  name: 'DataTable',

  props: {
    items: {
      type: [Object, Array],
      default: () => {
        return {}
      }
    }
  },

  data () {
    return {
      dataset: {}
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.datatable, this.items)
  },

  components: {
    AddMediaIcon,
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
    }
  }
}
</script>
