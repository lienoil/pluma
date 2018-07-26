<template>
  <v-layout row wrap align-start justify-start @click.native="unselected">

    <template v-for="(item, i) in items">
      <media-file
        :key="i"
        :item.sync="item"
        :ref="`media-file-${i}`"
        :tabindex="i"
        @open="selected"
        @remove="remove(item, i)"
        >
      </media-file>
    </template>

  </v-layout>
</template>

<script>
import store from '../store'
import { mapGetters } from 'vuex'

export default {
  store,

  name: 'MediaList',

  props: {
    items: {
      type: [Array, Object],
      default: () => {
        return []
      }
    },
  },

  data () {
    return {
      context: {
        show: false,
        x: 0,
        y: 0
      },

      editing: false
    }
  },

  computed: {
    ...mapGetters({
      mediabox: 'mediabox/mediabox',
    }),
  },

  methods: {
    selected (item) {
      this.$emit('selected', item)
    },

    remove (item, i) {
      this.items.splice(i, 1)
    },

    unselected () {
      this.$store.dispatch('mediabox/unselect', {selected: null})
    }
  }
}
</script>
