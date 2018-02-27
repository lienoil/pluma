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
      <v-btn ref="mediabox-browser-button" flat @click="media.box.model = ! media.box.model">Browse</v-btn>
    </v-card-actions>

    <!-- Dialog -->
    <template>
      <v-dialog v-model="media.box.model" max-width="100%" lazy scrollable persistent>
        <v-card>
          <v-toolbar dark>
            <v-toolbar-side-icon @click="media.sidebar.model = ! media.sidebar.model"></v-toolbar-side-icon>
            <v-toolbar-title class="body-2" v-html="title"></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-text-field prepend-icon="search" v-model="media.search.query" solo-inverted label="Search"></v-text-field>
            <v-btn icon @click="media.box.model = false"><v-icon>close</v-icon></v-btn>
          </v-toolbar>
          <v-divider></v-divider>
          <v-card-text class="pa-0">
            <v-container fluid grid-list-lg>
              <v-data-iterator
                :items="media.items"
                :pagination.sync="media.pagination"
                :search="media.search.query"
                select-all
                no-data-text="No Media Found"
                content-tag="v-layout"
                row
                wrap
              >
                <v-flex
                  slot="item"
                  slot-scope="props"
                  xs12
                  sm6
                  md3
                  lg2
                >
                  <v-card role="button">
                    <v-card-media class="accent" height="180px" :src="props.item.src"></v-card-media>
                    <v-btn @click="select(props.item)">Click</v-btn>
                  </v-card>
                </v-flex>
              </v-data-iterator>
            </v-container>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="secondary" flat @click="media.box.model = false">Cancel</v-btn>
            <v-btn color="primary" flat @click="">Select</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
    <!-- Dialog -->
  </v-card>
</template>

<script>
export default {
  props: {
    icon: { default: 'landscape' },
    title: { default: 'Media Manager' },
    multiple: { default: false },
    url: {}
  },
  model: {
    prop: 'selected'
  },
  data () {
    return {
      selected: null,
      media: {
        box: {
          model: false
        },
        sidebar: {
          model: false
        },
        selected: {
          src: '',
          alt: ''
        },
        search: {
          query: ''
        },
        items: [
          { name: 'mountain', src: '//source.unsplash.com/100x100?mountain' },
          { name: 'lake', src: '//source.unsplash.com/100x100?lake' },
          { name: 'river', src: '//source.unsplash.com/100x100?river' },
          { name: 'sea', src: '//source.unsplash.com/100x100?sea' },
          { name: 'bike', src: '//source.unsplash.com/100x100?bike' },
          { name: 'building', src: '//source.unsplash.com/100x100?building' },
          { name: 'volcano', src: '//source.unsplash.com/100x100?volcano' },
          { name: 'stones', src: '//source.unsplash.com/100x100?stones' },
          { name: 'mushroom', src: '//source.unsplash.com/100x100?mushroom' }
        ],
        pagination: {
          rowsPerPageItems: 4
        }
      }
    }
  },
  methods: {
    select (item) {
      if (this.multiple) {
        this.selected.push(item)
      } else {
        this.selected = item
        this.media.box.model = !this.media.box.model
      }
      console.log(this.selected)
      this.media.selected = item
    }
  }
}
</script>
