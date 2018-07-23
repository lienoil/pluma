<template>
  <v-slide-y-transition>
    <v-card>
      <v-data-table
        :headers="dataset.headers"
        :items="dataset.items"
        :search="dataset.search"
        >
        <template
          slot="items"
          slot-scope="props"
          >
          <td>
            <v-checkbox
              hide-details
              v-model="props.item.selected">
            </v-checkbox>
          </td>
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
                v-html="props.item.title"
                slot="activator"
                >
              </a>
              <span v-html="props.item.title"></span>
            </v-tooltip>
          </td>
          <td v-html="props.item.category"></td>
          <td v-html="props.item.timestamp"></td>
          <td v-html="props.item.part"></td>
          <td v-html="props.item.status"></td>
          <td class="text-xs-center">
            <v-tooltip bottom width="50">
              <v-icon
                slot="activator"
                small
                class="mx-3"
                @click=""
                >
                edit
              </v-icon>
              <span>Edit</span>
            </v-tooltip>
            <v-tooltip bottom>
              <v-icon
                slot="activator"
                small
                class="mx-3"
                @click=""
                >
                delete
              </v-icon>
              <span>Delete</span>
            </v-tooltip>
          </td>
        </template>
        <v-alert
          slot="no-results"
          :value="true"
          color="error"
          icon="warning"
          >
          Your search for "{{ search }}" found no results.
        </v-alert>
      </v-data-table>
    </v-card>
  </v-slide-y-transition>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
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
