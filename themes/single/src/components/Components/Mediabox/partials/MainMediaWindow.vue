<template>
  <v-card flat color="transparent" height="67vh" @contextmenu="prevent">

    <main-media-window-empty-state v-if="isFilesEmpty"></main-media-window-empty-state>

    <v-container fluid grid-list-lg fill-height>
      <quick-recent-media-window v-if="haveQuickRecents"></quick-recent-media-window>

      <v-layout row wrap>
        <v-flex xs12>
          <h4 class="text--disabled">{{ trans('Files') }}</h4>
          <media-list></media-list>
        </v-flex>
      </v-layout>
    </v-container>
  </v-card>
</template>

<script>
import MainMediaWindowEmptyState from './MainMediaWindowEmptyState'
import MediaList from './MediaList'
import QuickRecentMediaWindow from './QuickRecentMediaWindow'

export default {
  name: 'MainMediaWindow',
  components: {
    MainMediaWindowEmptyState,
    QuickRecentMediaWindow,
    MediaList
  },

  data () {
    return {
      recents: [],
      files: []
    }
  },

  computed: {
    haveQuickRecents () {
      return this.recents.length
    },

    isFilesEmpty () {
      return !this.files.length
    }
  },

  methods: {
    prevent (e) {
      e.preventDefault()
    }
  }
}
</script>
