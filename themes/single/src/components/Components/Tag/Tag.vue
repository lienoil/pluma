<template>
  <v-combobox
    :clearable="dataset.clearable"
    :hint="dataset.hint"
    :items="dataset.items"
    :label="dataset.label"
    :multiple="dataset.multiple"
    :persistent-hint="dataset.persistentHint"
    :search-input.sync="dataset.search"
    append-icon="keyboard_arrow_down"
    box
    chips
    clear-icon="cancel"
    v-model="dataset.model"
    >
    <template
      slot="selection"
      slot-scope="props"
      >
      <v-chip
        :selected="props.selected"
        close
        @input="remove(props.item)"
        >
        {{ props.item }}
      </v-chip>
    </template>
    <template slot="no-data">
      <v-list-tile>
        <v-list-tile-content>
          <v-list-tile-title>
            No results matching
            "<strong>{{ dataset.search }}</strong>".
            Press
              <kbd class="secondary">enter</kbd>
              to create a new one
          </v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </template>
  </v-combobox>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'Tag',

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

  methods: {
    remove (item) {
      this.dataset.model.splice(this.dataset.model.indexOf(item), 1)
      this.dataset.model = [...this.dataset.model]
    }
  },

  mounted () {
    this.dataset = Object.assign({}, this.tag, this.items)
  },

  computed: {
    ...mapGetters({
      tag: 'tag/tag'
    })
  }
}
</script>

