<template>
  <v-card>
    <v-card-title>
      Nutrition
      <v-spacer></v-spacer>
      <v-text-field
        append-icon="search"
        hide-details
        label="Search"
        single-line
        v-model="dataset.search"
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="dataset.headers"
      :items="dataset.items"
      :search="dataset.search"
    >
      <template slot="items" slot-scope="props">
        <td v-html="props.item.id"></td>
        <td>
          <v-avatar size="36px">
            <img :src="props.item.thumbnail">
          </v-avatar>
        </td>
        <td v-html="props.item.title"></td>
        <td v-html="props.item.category"></td>
        <td v-html="props.item.timestamp"></td>
        <td v-html="props.item.part"></td>
        <td width="10%">
          <v-btn icon><v-icon>edit</v-icon></v-btn>
        </td>
        <td width="10%">
          <v-btn icon><v-icon>delete</v-icon></v-btn>
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
