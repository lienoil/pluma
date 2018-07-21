<template>
  <v-card flat color="transparent" height="67vh" @contextmenu="prevent">

    <main-media-window-empty-state v-if="isFilesEmpty"></main-media-window-empty-state>
    <quick-recent-media-window v-if="haveQuickRecents"></quick-recent-media-window>

    <v-container fluid grid-list-lg fill-height>
      <v-layout row wrap>
        <v-flex xs12>
          <h4 class="media-window__subheader text--disabled">{{ trans('Files') }}</h4>
          <media-list :items="folders"></media-list>
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
        { renaming: false, type: 'folder', color: 'goldenrod', code: 'pictures', foldertype: 'image', title: 'Pictures' },
        { renaming: false, type: 'folder', color: 'goldenrod', code: 'music', foldertype: 'audio', title: 'Music' },
        { renaming: false, type: 'folder', color: 'goldenrod', code: 'generic', foldertype: 'generic', title: 'Apps' },
        { renaming: false, type: 'folder', color: 'goldenrod', code: 'documents', foldertype: 'generic', title: 'Documents' },
        { renaming: false, type: 'file', filetype: 'txt', color: '#7171b3', code: 'db_schema', title: 'db_schema.txt' },
      ],
    }
  },

  computed: {
    haveQuickRecents () {
      return this.recents.length
    },

    isFilesEmpty () {
      return !this.folders.length
    }
  },

  methods: {
    prevent (e) {
      e.preventDefault()
    },
    add () {
      let folder = {
        renaming: true,
        color: 'goldenrod',
        code: 'new-folder',
        foldertype: 'image',
        title: 'New Folder',
      }
      this.folders.push(folder)
    },
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
