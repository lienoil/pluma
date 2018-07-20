<template>
  <v-card flat color="transparent" height="67vh" @contextmenu="prevent">

    <!-- <main-media-window-empty-state v-if="isFilesEmpty"></main-media-window-empty-state> -->

    <quick-recent-media-window v-if="haveQuickRecents"></quick-recent-media-window>

    <v-container fluid grid-list-lg fill-height>
      <v-layout row wrap>
        <v-flex xs12>
          <h4 class="media-window__subheader text--disabled">{{ trans('Folders') }}</h4>
          <media-list :items="folders"></media-list>
        </v-flex>
        <v-flex xs12>
          <h4 class="media-window__subheader text--disabled">{{ trans('Files') }}</h4>
          <media-list :items="files"></media-list>
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
      folders: [
        { renaming: false, color: 'goldenrod', code: 'pictures', foldertype: 'image', title: 'Pictures' },
        { renaming: false, color: this.$vuetify.theme.primary, code: 'music', foldertype: 'audio', title: 'Music' },
        { renaming: false, color: this.$vuetify.theme.primary, code: 'generic', foldertype: 'generic', title: 'Apps' },
        { renaming: false, color: this.$vuetify.theme.primary, code: 'documents', foldertype: 'generic', title: 'Documents' },
      ],
      files: [
        { renaming: false, color: 'goldenrod', code: 'pictures', foldertype: 'image', title: 'Pictures' },
        { renaming: false, color: this.$vuetify.theme.primary, code: 'music', foldertype: 'audio', title: 'Music' },
      ],
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

<style lang="stylus">
.media-window {
  &__subheader {
    touch-callout: none;
    user-select: none;
  }
}
</style>
