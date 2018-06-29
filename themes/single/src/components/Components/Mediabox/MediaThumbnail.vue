<template>
  <v-card>
    <v-toolbar
      v-if="!hideToolbar"
      card
      dense
      >
      <v-icon>{{ toolbarIcon }}</v-icon>
      <v-toolbar-title class="subheading">{{ toolbarTitle }}</v-toolbar-title>
    </v-toolbar>
  </v-card>
</template>

<script>
export default {
  name: 'MediaThumbnail',
  props: {
    hideToolbar: { type: Boolean, default: false },
    toolbarIcon: { type: String, default: 'landscape' },
    toolbarTitle: { type: String, default: 'Media' }
  }
}
</script>
