<template>
  <v-layout row wrap align-start justify-start>

    <folder
      :key="i"
      :ref="`folder-${i}`"
      :metadata.sync="item"
      @click.native="select"
      v-for="(item, i) in items"
      >
    </folder>

  </v-layout>
</template>

<script>
import store from '@/components/Components/Folder/store'
import Vue from 'vue'
import Sortable from 'vue-sortable'
import { mapGetters } from 'vuex'

Vue.use(Sortable)

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
    select ($event) {
      //
    },

    open () {
      alert('doiuble clicj')
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

    rename (props, i) {
      console.log(props, i)
      props.folder.item.renaming = true
      this.folders[i].renaming = true
      // folder.renaming = true
    }
  }
}
</script>
