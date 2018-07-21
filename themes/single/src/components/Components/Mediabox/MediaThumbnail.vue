<template>
  <v-card flat tile color="transparent empty_state--hover">
    <v-toolbar
      v-if="!hideToolbar"
      card
      dense
      >
      <v-icon>{{ toolbarIcon }}</v-icon>
      <v-toolbar-title class="subheading">{{ toolbarTitle }}</v-toolbar-title>
    </v-toolbar>

    <!-- Empyt States -->
    <slot name="empty">
      <v-layout v-if="hasNoThumbnail" column wrap align-center justify-center class="pa-4">
        <component :is="noMediaThumbnail" width="80px" height="80px" class="empty_state--disabled"></component>
        <div class="grey--text" v-html="noMediaText"></div>
        <div class="grey--text caption" v-html="noMediaCaption"></div>
      </v-layout>
    </slot>
    <!-- Empyt States -->

    <!-- Thumbnail Preview -->
    <slot name="preview">
      <v-card-media v-if="hasThumbnail">
        <img :src="thumbnail" width="100%" height="auto">
      </v-card-media>
    </slot>
    <!-- Thumbnail Preview -->
  </v-card>
</template>

<script>
import noMediaThumbnail from '@/components/Icons/MediaIcon'
import store from '@/components/Components/Folder/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'MediaThumbnail',
  components: {
    noMediaThumbnail
  },
  props: {
    hideToolbar: { type: Boolean, default: false },
    toolbarIcon: { type: String, default: 'landscape' },
    toolbarTitle: { type: String, default: 'Media' },
    thumbnail: { type: String, default: null },
    noMediaThumbnail: { type: String, default: noMediaThumbnail },
    noMediaText: { type: String, default: 'No media found' },
    noMediaCaption: { type: String, default: null }
  },

  computed: {
    ...mapGetters({
      file: 'folder/file',
    }),
    hasNoThumbnail: function () {
      return this.file.selected.type !== 'file'
    },

    hasThumbnail: function () {
      return this.file.selected.type === 'file' // !== null
    },
  },

  data () {
    return {
      //
    }
  },

  mounted () {
    console.log(this.file)
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
