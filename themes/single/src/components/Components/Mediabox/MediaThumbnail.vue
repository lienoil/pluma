<template>
  <v-card flat tile color="transparent" class="media-thumbnail">
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
      <v-card flat color="transparent" class="empty_state--hover">
        <v-layout v-if="hasNoThumbnail" @click="open" column wrap align-center justify-center class="pa-4">
          <component :is="noMediaThumbnail" width="80px" height="80px" class="empty_state--disabled"></component>
          <div class="grey--text" v-html="noMediaText"></div>
          <div class="grey--text caption" v-html="noMediaCaption"></div>
        </v-layout>
      </v-card>
    </slot>
    <!-- Empyt States -->

    <!-- Thumbnail Preview -->
    <v-card flat v-if="hasThumbnail">
      <slot name="preview" :props="{item: mediathumbnail.item, unset: unset}">
        <img :src="mediathumbnail.item.thumbnail" @contextmenu="open" @click.prevent="open" class="media-thumbnail__preview">
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn dark depressed icon small color="error" @click.prevent="unset"><v-icon small>close</v-icon></v-btn>
        </v-card-actions>
      </slot>
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
      mediabox: 'mediabox/mediabox',
      mediawindow: 'mediawindow/mediawindow',
      mediathumbnail: 'mediathumbnail/mediathumbnail',
    }),

    hasNoThumbnail: function () {
      return !this.mediathumbnail.item
    },

    hasThumbnail: function () {
      return this.mediathumbnail.item
    },
  },

  methods: {
    ...mapActions({
      unset: 'mediathumbnail/unset',
      toggle: 'mediawindow/toggle',
    }),

    open () {
      this.$store.dispatch('mediawindow/toggle', {model: !this.mediawindow.model})
    },
  },
}
</script>

<style lang="stylus">
.media-thumbnail {
  &__preview {
    cursor: pointer;
    height: auto;
    position: absolute;
    width: 100%;
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
