<template>
  <v-card>
    <v-toolbar card class="transparent">
      <v-icon v-html="icon"></v-icon>
      <v-toolbar-title class="body-2 grey--text text--darken-2" v-html="title"></v-toolbar-title>
    </v-toolbar>
    <v-card-text role="button" @click="$refs['mediabox-browser-button'].click()" >
      <template v-if="media.selected.src">
        <img width="100%" height="auto" :src="media.selected.src" :alt="media.selected.alt">
      </template>
      <template v-else>
        <p class="grey--text text-xs-center">No image selected</p>
      </template>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn ref="mediabox-browser-button" flat>Browse</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    icon: { default: 'landscape' },
    title: { default: 'Media Manager' }
  },
  data () {
    return {
      media: {
        selected: {
          src: '',
          alt: ''
        }
      }
    }
  }
}
</script>
