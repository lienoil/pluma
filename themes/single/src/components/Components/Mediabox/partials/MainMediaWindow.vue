<template>
  <v-card flat color="transparent" clsas="media-window" @contextmenu="prevent">

    <main-media-window-empty-state v-if="isFilesEmpty"></main-media-window-empty-state>

    <quick-recent-media-window v-if="haveQuickRecents"></quick-recent-media-window>

    <v-container fluid fill-height v-if="!isFilesEmpty" class="pa-0">
      <v-layout fill-height row wrap class="ma-0">
        <v-flex fill-height v-bind="{sm9: details, xs12: !details}">
          <v-container fluid fill-height grid-list-lg>
            <v-layout row wrap>
              <v-flex xs12>
                <h4 class="media-window__subheader text--disabled">{{ trans('Files') }}</h4>
                <media-list :items="mediabox.items"></media-list>
              </v-flex>
            </v-layout>
          </v-container>
        </v-flex>
        <v-flex fill-height xs12 sm3 v-if="details" class="media-window__file-details">
          <file-details v-if="details" v-model.sync="mediabox.selected"></file-details>
        </v-flex>
      </v-layout>
    </v-container>
  </v-card>
</template>

<script>
import store from '../store'
import MainMediaWindowEmptyState from './MainMediaWindowEmptyState'
import MediaList from './MediaList'
import QuickRecentMediaWindow from './QuickRecentMediaWindow'
import { mapGetters } from 'vuex'

export default {
  store,

  name: 'MainMediaWindow',

  components: {
    MainMediaWindowEmptyState,
    QuickRecentMediaWindow,
    MediaList
  },

  data () {
    return {
      recents: [],
    }
  },

  computed: {
    ...mapGetters({
      mediabox: 'mediabox/mediabox',
    }),

    haveQuickRecents () {
      return this.recents.length
    },

    isFilesEmpty () {
      return !this.mediabox.items
    },

    details () {
      return this.mediabox.toolbar.details.model
    }
  },

  created () {
    this.$http.get('/api/v1/library')
      .then((response) => {
        this.$store.dispatch('mediabox/set', {items: response.data.data, total: response.data.total})
      })
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
  div {
    touch-callout: none;
    user-select: none;
  }

  &__subheader {
    touch-callout: none;
    user-select: none;
  }

  &__file-details {
    background-color: rgba(0,0,0,0.02);
  }
}
</style>
