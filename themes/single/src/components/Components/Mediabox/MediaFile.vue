<template>
  <file
    :metadata.sync="item"
    @dropped="move"
    @open="open"
    @remove="remove(item, i)"
    @selected="selected"
    @unselected="unselected"
  ></file>
</template>

<script>
import store from './store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'MediaFile',

  props: {
    item: {
      type: [Object],
      default: () => {
        return {}
      }
    },
  },

  computed: {
    ...mapGetters({
      mediabox: 'mediabox/mediabox',
      mediawindow: 'mediawindow/mediawindow',
      mediathumbnail: 'mediathumbnail/mediathumbnail',
    })
  },

  methods: {
    open (item) {
      this.$store.dispatch('mediathumbnail/set', {item: item})
      this.$store.dispatch('mediawindow/toggle', {model: false})
      this.$emit('open', item)
    },

    move (item, i) {
      // move
    },

    remove (item, i) {
      this.$emit('remove', {item, i})
    },

    selected (item) {
      this.$store.dispatch('mediathumbnail/set', {item: item})
      this.$store.dispatch('mediabox/select', {selected: item})
      this.$emit('selected', item)
    },

    unselected () {
      this.$emit('unselected')
    },
  }
}
</script>
