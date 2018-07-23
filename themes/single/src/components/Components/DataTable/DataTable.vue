<template>
  <v-transition-group transition="scale-transition">
    <v-card>
      <v-card-title class="emphasis--medium">
        <v-text-field
          full-width
          hide-details
          label="Search"
          append-icon="search"
          single-line
          solo
          clearable
          flat
          v-model="dataset.search"
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="dataset.headers"
        :items="dataset.items"
        :search="dataset.search"
        >
        <template
          slot="items"
          slot-scope="props"
          >
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
          <td class="text-xs-right">
            <v-tooltip bottom width="50">
              <v-btn icon slot="activator">
                <v-icon small>edit</v-icon>
              </v-btn>
              <span>Edit</span>
            </v-tooltip>
          </td>
          <td class="text-xs-right">
            <v-tooltip bottom>
              <v-btn icon slot="activator">
                <v-icon small>delete</v-icon>
              </v-btn>
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
  </v-transition-group>
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
