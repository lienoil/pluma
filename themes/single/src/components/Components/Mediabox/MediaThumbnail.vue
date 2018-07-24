<template>
  <v-card flat tile color="transparent empty_state--hover" @click="toggle">
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
      <v-card-media v-if="hasThumbnail" :src="mediathumbnail.item.thumbnail" height="200px">
        <v-layout row wrap fill-height align-start justify-end>
          <v-btn dark depressed icon small color="error" @click.prevent="unset"><v-icon small>close</v-icon></v-btn>
        </v-layout>
      </v-card-media>
    </slot>
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
  },
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
