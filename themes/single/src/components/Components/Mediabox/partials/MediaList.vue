<template>
  <v-layout row wrap align-start justify-start>

    <template v-for="(item, i) in items">
      <file
        :key="i"
        :metadata.sync="item"
        :ref="`file-${i}`"
        :tabindex="i"
        @click.native="select"
        @dropped="move"
        @remove="remove(item, i)"
        @open="open"
        >
      </file>
    </template>

  </v-layout>
</template>

<script>
import store from '@/components/Components/Folder/store'
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
      folder: 'folder/folder',
      contextmenu: 'contextmenu/contextmenu',
    })
  },

  methods: {
    open () {
      alert('opened')
    },

    menu (e, folder, i) {
      this.context.x = e.clientX
      this.context.y = e.clientY
      this.context.show = true
      this.context.folders = this.folders
      this.context.data = folder
      this.context.id = i
      this.$store.dispatch('folder/openContextMenu', this.context)
    },

    move (item, i) {
      console.log(item, i)
    },

    remove (item, i) {
      this.items.splice(i, 1)
    }
  }
}
</script>
