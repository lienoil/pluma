<template>
  <v-card class="card-mediabox">
    <v-toolbar card class="transparent">
      <v-icon v-html="icon"></v-icon>
      <v-toolbar-title class="body-2 grey--text text--darken-2" v-html="title"></v-toolbar-title>
    </v-toolbar>
    <div class="card-mediabox-container">
      <template v-if="(selected instanceof Array) && selected.length !== 0">
        <img class="stacked" width="100%" height="auto" v-for="(s, i) in selected" :key="i" :src="s">
      </template>
      <template v-else-if="typeof selected === 'string' && selected">
        <img width="100%" height="auto" :src="selected">
      </template>
      <template v-else>
        <p class="grey--text text-xs-center">No image selected</p>
      </template>
    </div>
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
    closeOnClick: { default: true },
    icon: { default: 'landscape' },
    itemText: { default: 'text' },
    itemValue: { default: 'value' },
    multiple: { default: false },
    title: { default: 'Mediabox' },
    url: {}
  },
  model: {
    prop: 'selected'
  },
  data () {
    return {
      selected: [],
      media: {
        box: {
          model: false
        },
        sidebar: {
          model: false
        },
        search: {
          query: ''
        },
        items: [
          { text: 'mountain', value: '//source.unsplash.com/100x100?mountain' },
          { text: 'lake', value: '//source.unsplash.com/100x100?lake' },
          { text: 'river', value: '//source.unsplash.com/100x100?river' },
          { text: 'sea', value: '//source.unsplash.com/100x100?sea' },
          { text: 'bike', value: '//source.unsplash.com/100x100?bike' },
          { text: 'building', value: '//source.unsplash.com/100x100?building' },
          { text: 'volcano', value: '//source.unsplash.com/100x100?volcano' },
          { text: 'stones', value: '//source.unsplash.com/100x100?stones' },
          { text: 'mushroom', value: '//source.unsplash.com/100x100?mushroom' }
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
        this.selected.push(item[this.itemValue])
      } else {
        this.selected = null
        this.selected = item[this.itemValue]

        if (this.closeOnClick) {
          this.media.box.model = !this.media.box.model
        }
      }
      this.$emit('input', this.selected)
    }
  }
}
</script>

<style scoped>
.card-mediabox-container {
  position: relative;
  overflow: hidden;
  min-height: 120px;
}
.card-mediabox-container .stacked {
  position: absolute;
  top: 0;
  left: 0;
  transition: all 0.3s;
}
.card-mediabox-container .stacked:last-child {
  position: relative;
}
.card-mediabox-container .stacked:nth-child(2) {
  transform-origin: 0 100%;
}
.card-mediabox-container .stacked:nth-child(3) {
  transform-origin: 100 0;
}
</style>
