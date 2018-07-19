<template>
  <v-menu
    :position-x="contextmenu.x"
    :position-y="contextmenu.y"
    absolute
    lazy
    offset-y
    v-model="contextmenu.show"
    >
    <v-list>
      <v-list-tile @click="rename">
        <v-list-tile-action>
          <v-icon>mdi-rename-box</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ trans('Rename') }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile @click="move">
        <v-list-tile-action>
          <v-icon>mdi-folder-move</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ trans('Move to...') }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile @click="changetype">
        <v-list-tile-action>
          <v-icon>mdi-shape</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ trans('Change folder type') }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-divider></v-divider>

      <v-list-tile @click="download">
        <v-list-tile-action>
          <v-icon>mdi-download</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ trans('Download') }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-divider></v-divider>

      <v-list-tile @click="trash">
        <v-list-tile-action>
          <v-icon>mdi-delete</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>{{ trans('Remove') }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>
  </v-menu>
</template>

<script>
import store from './store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'ContextMenu',

  props: {
    x: {
      type: [Number],
      default: 0
    },
    y: {
      type: [Number],
      default: 0
    }
  },

  computed: {
    ...mapGetters({
      contextmenu: 'contextmenu/contextmenu',
    })
  },

  methods: {
    rename (e) {
      console.log('emitting rename event from contextmenu.')
      this.$emit('rename')
      e.preventDefault()
    },

    renamed (value) {
      // this.editing = false
    },

    move () {},
    trash () {},
    download () {},
    changetype () {}
  },
}
</script>
