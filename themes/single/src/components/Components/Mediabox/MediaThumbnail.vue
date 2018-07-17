<template>
  <v-card flat color="transparent empty_state--hover">
    <v-toolbar
      v-if="!hideToolbar"
      card
      dense
      >
      <v-icon>{{ toolbarIcon }}</v-icon>
      <v-toolbar-title class="subheading">{{ toolbarTitle }}</v-toolbar-title>
    </v-toolbar>
    <v-layout column wrap align-center justify-center class="pa-4">
      <img :src="noMediaThumbnail" width="80px" class="empty_state--disabled">
      <div class="grey--text" v-html="noMediaText"></div>
      <div class="grey--text caption" v-html="noMediaCaption"></div>
    </v-card-text>
  </v-card>
</template>

<script>
import * as noMediaThumbnail from './assets/img/add-media.svg'

export default {
  name: 'MediaThumbnail',
  props: {
    hideToolbar: { type: Boolean, default: false },
    toolbarIcon: { type: String, default: 'landscape' },
    toolbarTitle: { type: String, default: 'Media' },
    noMediaThumbnail: { type: String, default: noMediaThumbnail },
    noMediaText: { type: String, default: 'Add photo' },
    noMediaCaption: { type: String, default: 'Tap on the icon to open the media window' }
  },

  data () {
    return {
      //
    }
  }
}
</script>

<style lang="stylus">
.empty {
  &_state {
    &--hover {
      cursor: pointer;
    }
    &--disabled {
      opacity: 0.6;
    }
  }
}
</style>
