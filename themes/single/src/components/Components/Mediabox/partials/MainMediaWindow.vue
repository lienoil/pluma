<template>
  <v-container fluid grid-list-lg fill-height>
    <quick-recent-media-window v-if="haveQuickRecents"></quick-recent-media-window>

    <v-layout row wrap>
      <v-flex xs12>
        <h4 class="text--disabled">{{ trans('Files') }}</h4>
        <media-list></media-list>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import QuickRecentMediaWindow from './QuickRecentMediaWindow'
import MediaList from './MediaList'

export default {
  name: 'MainMediaWindow',
  components: {
    QuickRecentMediaWindow,
    MediaList
  },

  data () {
    return {
      recents: []
    }
  },

  computed: {
    haveQuickRecents () {
      return this.recents.length
    }
  }
}
</script>
