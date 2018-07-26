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
import store from '../store'

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

  methods: {
    open (item) {
      this.$store.dispatch('mediawindow/toggle', {model: false})
      this.$emit('open', item)
    },

    move (item, i) {
      // move
    },

    remove (item, i) {
      this.$emit('remove', {item, i})
    },

    selected ({item}) {
      this.item.selected = true
      this.$nextTick(() => {
        this.$store.dispatch('mediabox/select', {selected: item})
        this.$store.dispatch('mediathumbnail/set', {item: item})
        this.$emit('selected', item)
      })
    },

    unselected () {
      this.$store.dispatch('mediabox/unselect', {selected: null})
      // this.$store.dispatch('mediathumbnail/unset', {item: null})
      this.$emit('unselected')
    },
  }
}
</script>
