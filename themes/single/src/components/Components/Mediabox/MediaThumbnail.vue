<template>
  <v-card
    class="media-thumbnail"
    color="transparent"
    flat
    tile
    >

    <v-toolbar
      card
      dense
      v-if="!hideToolbar"
      >
      <v-icon>{{ toolbarIcon }}</v-icon>
      <v-toolbar-title class="subheading">{{ toolbarTitle }}</v-toolbar-title>
    </v-toolbar>

    <!-- Empty State -->
    <slot name="empty">
      <v-card flat tile color="transparent" class="empty_state--hover">
        <v-layout v-if="hasNoThumbnail" @click="open" column wrap align-center justify-center class="pa-4">
          <component :is="noMediaThumbnail" width="80px" height="80px" class="empty_state--disabled"></component>
          <div class="grey--text" v-html="noMediaText"></div>
          <div class="grey--text caption" v-html="noMediaCaption"></div>
        </v-layout>
      </v-card>
    </slot>
    <!-- Empty State -->

    <!-- Thumbnail Preview -->
    <v-card flat tile v-if="hasThumbnail">
      <v-card-media
        :src="thumbnailpreview"
        @click.prevent="open"
        @contextmenu="open"
        class="media-thumbnail__preview"
        height="180px"
        >
      </v-card-media>
      <v-card-actions class="media-thumbnail__actions">
        <v-spacer></v-spacer>
        <v-btn dark depressed icon small color="error" @click.prevent="unset"><v-icon small>close</v-icon></v-btn>
      </v-card-actions>
    </v-card>
    <!-- Thumbnail Preview -->
  </v-card>
</template>

<script>
import noMediaThumbnail from '@/components/Icons/MediaIcon'
import store from './store'
import { mapActions, mapGetters } from 'vuex'

export default {
  store,

  name: 'MediaThumbnail',

  model: {
    prop: 'window',
  },

  components: {
    noMediaThumbnail
  },

  props: {
    window: { type: Boolean, default: false },
    hideToolbar: { type: Boolean, default: false },
    toolbarIcon: { type: String, default: 'landscape' },
    toolbarTitle: { type: String, default: 'Media' },
    thumbnail: { type: [Object, String], default: null },
    noMediaThumbnail: { type: String, default: noMediaThumbnail },
    noMediaText: { type: String, default: 'No media found' },
    noMediaCaption: { type: String, default: null }
  },

  computed: {
    ...mapGetters({
      mediabox: 'mediabox/mediabox',
      mediawindow: 'mediawindow/mediawindow',
    }),

    hasNoThumbnail: function () {
      return !this.thumbnail
    },

    hasThumbnail: function () {
      return this.thumbnail
    },

    thumbnailpreview: function () {
      return JSON.parse(JSON.stringify(this.thumbnail.thumbnail || this.thumbnail))
    },
  },

  methods: {
    ...mapActions({
      toggle: 'mediawindow/toggle',
    }),

    unset () {
      this.thumbnail = null
      this.$emit('unset', this.thumbnail)
    },

    open () {
      this.$emit('input', !this.window)
      // this.$store.dispatch('mediawindow/toggle', {model: !this.mediawindow.model})
    },
  },
}
</script>

<style lang="stylus">
.media-thumbnail {
  &__preview {
    cursor: pointer;
    height: auto;
    width: 100%;

    &:hover, &:focus, &:active {
      filter: brightness(110%);
    }
  }

  &__actions {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: auto;
  }
}
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
