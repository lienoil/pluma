<template>
  <div id="app">
    <v-app>
      <v-container fluid grid-list-lg>
        <v-layout row wrap>
          <v-flex>
            <v-btn @click="model = true">Browse Media</v-btn>
            <v-checkbox v-model="multiple" label="multiple" hide-details></v-checkbox>
            <v-checkbox v-model="closeOnClick" label="Close on click" hide-details></v-checkbox>
            <v-mediabox
              toolbar-label="Catalogues"
              :url="url"
              :categories="menus"
              v-model="model"
              search
              :multiple="multiple"
              :close-on-click="closeOnClick"
              @selected="getValue"
            ></v-mediabox>

            <pre>
              <span v-html="dataset"></span>
            </pre>

            <p>Display selected item from mediabox</p>
          </v-flex>
        </v-layout>
        <v-layout row wrap>
          <v-flex sm3 v-for="(dataset, i) in dataset" :key="i">
            <v-card class="mb-3 accent" role="button" @click.stop="model = true">
              <v-card-media height="250px" :src="dataset.thumbnail">
                <v-container fill-height fluid class="pa-0 white--text">
                  <v-layout column>
                    <v-card-title class="subheading" v-html="dataset.name"></v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-actions class="px-2 white--text">
                      <v-icon class="white--text" v-html="dataset.icon"></v-icon>
                      <v-spacer></v-spacer>
                      <span v-html="dataset.mimetype"></span>
                      <span v-html="dataset.size"></span>
                    </v-card-actions>
                  </v-layout>
                </v-container>
              </v-card-media>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-app>
  </div>
</template>

<script>
import Mediabox from '../src/Mediabox.vue'

export default {
  name: 'app',
  components: { 'v-mediabox': Mediabox },
  data () {
    return {
      model: false,
      dataset: null,
      multiple: true,
      closeOnClick: false,
      old: [{
            "id": "2",
            "name": "Egypt",
            "thumbnail": "//source.unsplash.com/900x600?egypt",
            "mimetype": "image/png",
            "size": "720KB",
            "icon": "image",
            "active": true
          }],
      url: '../src/assets/test-data.json',
      menus: [
        {
          icon: 'perm_media',
          name: 'All',
          count: '4',
          code: 'perm_media',
          active: true,
          url: '../src/assets/test-data.json',
        },
        {
          icon: 'collections',
          name: 'Collections',
          count: '4',
          code: 'collections',
          url: '../src/assets/test-data.collection.json',
        },
        {
          icon: 'album',
          name: 'Album',
          count: '4',
          code: 'album',
          url: '../src/assets/test-data.json',
        }
      ]
    }
  },
  methods: {
    'getValue'(value) {
      this.dataset = value
      this.old = value
    }
  }
}
</script>

<style>
@import '~vuetify/dist/vuetify.min.css';
</style>
