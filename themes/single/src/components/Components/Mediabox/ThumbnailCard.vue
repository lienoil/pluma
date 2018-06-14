<template>
  <v-card class="card--thumbnail card-mediabox">
    <template v-if="!hideToolbar">
      <v-toolbar
        card
        dense
        >
        <v-icon v-html="icon"></v-icon>
        <v-toolbar-title class="body-2" v-html="title"></v-toolbar-title>
      </v-toolbar>
    </template>

    <v-card
      :class="{'card-mediabox-container image-transparent': thumbnailPreview}"
      :height="height"
      @click.native="media.box.model = !media.box.model"
      flat
      ripple
      role="button"
      tile
      >
      <template v-if="(selected instanceof Array) && selected.length !== 0">
        <slot name="thumbnail" :props="{item: media.selected}">
          <img class="stacked" v-for="(s, i) in selected" :key="i" :src="s">
        </slot>
      </template>
      <template v-else-if="typeof selected === 'string' && selected">
        <slot name="thumbnail" :props="{item: media.selected, src: selected}">
          <img :src="selected">
          <v-spacer></v-spacer>
          <v-card flat tile>
            <v-card-actions>
              <v-tooltip bottom>
                <v-btn slot="activator" color="white" icon><v-icon color="red" v-html="media.selected[itemIcon]"></v-icon></v-btn>
                <span v-html="media.selected[itemMimetype]"></span>
              </v-tooltip>
              <span class="body-1" v-html="media.selected[itemText]"></span>
            </v-card-actions>
            <v-divider></v-divider>
          </v-card>
        </slot>
      </template>
      <template v-else>
        <slot name="no-image-text" :props="{text: noImageText}">
          <v-card-text class="layout column ma-0 justify-center align-center">
            <v-icon class="text--disabled display-3">add_box</v-icon>
            <strong class="text--disabled" v-html="noImageText"></strong>
          </v-card-text>
        </slot>
      </template>
      <!--  -->
    </v-card>
</template>

<script>
export default {
  name: 'ThumbnailCard',
  props: {
    closeOnClick: { type: Boolean, default: true },
    headers: { type: Array, default: () => { return [] } },
    height: { type: String, default: 'auto' },
    hideActions: { type: Boolean, default: false },
    hideToolbar: { type: Boolean, default: false },
    icon: { type: String, default: 'landscape' },
    itemDate: { type: String, default: 'created' },
    itemIcon: { type: String, default: 'icon' },
    itemMimetype: { type: String, default: 'mimetype' },
    itemSize: { type: String, default: 'filesize' },
    itemText: { type: String, default: 'text' },
    itemValue: { type: String, default: 'value' },
    menuItemId: { type: String, default: 'catalogue_id' },
    menuItems: { type: Array, default: () => { return [] } },
    multiple: { type: Boolean, default: false },
    noImageText: { type: String, default: 'Add image' },
    noMediaText: { type: String, default: 'No media found' },
    params: { type: Object, default: () => { return {} } },
    thumbnailPreview: { type: Boolean, default: false },
    title: { type: String, default: 'Mediabox' },
    uploadText: { type: String, default: 'Upload' },
    url: { type: Object, default: () => { return { all: '/', search: '/' } } }
  },
  model: {
    prop: 'selected'
  }
}
</script>
