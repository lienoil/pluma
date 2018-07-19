<template>
  <v-layout row wrap align-start justify-start>

    <folder
      :key="i"
      :ref="`folder-${i}`"
      v-model="folder"
      @click.native="select"
      @contextmenu.native="menu($event, folder, i)"
      v-for="(folder, i) in folders"
      ></folder>

    <context-menu></context-menu>
  </v-layout>
</template>

<script>
import store from '@/store'
import Vue from 'vue'
import Folder from '@/components/Components/Folder/Folder'
import ContextMenu from '@/components/Components/Folder/ContextMenu'
import Sortable from 'vue-sortable'
import { mapGetters } from 'vuex'

Vue.use(Sortable)

export default {
  store,
  name: 'MediaList',

  components: {
    Folder,
    ContextMenu
  },

  data () {
    return {
      folders: [
        { renaming: false, color: 'goldenrod', code: 'pictures', foldertype: 'image', title: 'Pictures' },
        { renaming: false, color: 'blue', code: 'music', foldertype: 'audio', title: 'Music' }
      ],

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
      folder: 'folder/folder'
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

    rename (val) {
      this.editing = true
    }
  }
}
</script>
