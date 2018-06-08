<template>
  <v-card class="card-mediabox">
    <v-toolbar card dense v-if="!hideToolbar">
      <v-icon v-html="icon"></v-icon>
      <v-toolbar-title class="body-2" v-html="title"></v-toolbar-title>
    </v-toolbar>
    <v-card flat tile :class="{'card-mediabox-container image-transparent': thumbnailPreview}" ripple :height="height" role="button" @click.native="media.box.model = !media.box.model">
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
            <v-icon class="text-emphasis--medium display-3">add_box</v-icon>
            <strong class="text-emphasis--medium" v-html="noImageText"></strong>
          </v-card-text>
        </slot>
      </template>
    </v-card>


    <slot name="thumbnail-details" :props="{item: media.selected, src: selected}"></slot>
    <!-- <v-card-actions v-if="!hideActions">
      <v-btn v-if="selected.length !== 0" ref="mediabox-clear-button" flat @click="remove(selected)">Remove</v-btn>
      <v-spacer></v-spacer>
      <v-btn ref="mediabox-browser-button" flat @click="media.box.model = ! media.box.model">{{ selected.length === 0 ? 'Browse' : 'Change' }}</v-btn>
    </v-card-actions> -->

    <!-- Dialog -->
    <template>
      <v-dialog class="white" v-model="media.box.model" max-width="100%" lazy scrollable persistent>
        <mediabox-window></mediabox-window>
      </v-dialog>
    </template>
    <!-- Dialog -->
  </v-card>
</template>

<script>
import Upload from '@/components/Components/Upload.vue'
import _unionBy from 'lodash/unionBy'
import _isEmpty from 'lodash/isEmpty'
import MediaboxWindow from './MediaboxWindow'

export default {
  props: {
    closeOnClick: { type: Boolean, default: true },
    headers: { type: Array, default: () => { return [] } },
    height: { type: String, default: 'auto' },
    hideActions: { type: Boolean, default: false },
    thumbnailPreview: { type: Boolean, default: false },
    hideToolbar: { type: Boolean, default: false },
    icon: { type: String, default: 'landscape' },
    itemDate: { type: String, default: 'created' },
    menuItemId: { type: String, default: 'catalogue_id' },
    itemIcon: { type: String, default: 'icon' },
    itemMimetype: { type: String, default: 'mimetype' },
    itemSize: { type: String, default: 'filesize' },
    itemText: { type: String, default: 'text' },
    itemValue: { type: String, default: 'value' },
    menuItems: { type: Array, default: () => { return [] } },
    params: { type: Object, default: () => { return {} } },
    multiple: { type: Boolean, default: false },
    noImageText: { type: String, default: 'Select image' },
    noMediaText: { type: String, default: 'No media found' },
    title: { type: String, default: 'Mediabox' },
    uploadText: { type: String, default: 'Upload' },
    url: { type: Object, default: () => { return { all: '/', search: '/' } } }
  },
  model: {
    prop: 'selected'
  },
  components: {
    Upload,
    MediaboxWindow
  },
  data () {
    return {
      selected: [],
      media: {
        box: { model: false },
        headers: this.headers.length ? this.headers : [
          { text: 'Name', align: 'left', value: 'name' },
          { text: 'File Type', align: 'left', value: 'mimetype' },
          { text: 'File Size', align: 'left', value: 'size' },
          { text: 'Upload Date', align: 'left', value: 'created_at' }
        ],
        items: [],
        selected: [],
        loading: true,
        search: { query: '' },
        sidebar: {
          model: false,
          mini: this.$root.localstorage('single.media.sidebar.mini') === 'true'
        },
        url: this.url.all,
        pagination: {
          rowsPerPageItems: [12, 24, 30, {'text': 'All', 'value': -1}],
          rowsPerPageText: 'Items per page:',
          totalItems: 0
        },
        toggleview: 'grid'
      },
      menus: {
        current: { tabmodel: 'Upload' },
        upload: { name: 'Upload', icon: 'cloud_upload', model: false },
        items: []
      }
    }
  },
  watch: {
    'media.url': function (val) {
      this.get()
    },
    'media.search.query': function (val) {
      this.search(val)
    },
    'menuItems': function (val) {
      this.menus.items = val
    },
    'media.pagination': {
      handler () {
        this.get()
      },
      deep: true
    }
  },
  methods: {
    get () {
      const { sortBy, descending, page, rowsPerPage } = this.media.pagination
      let query = Object.assign({
        catalogue_id: this.menus.current.catalogue_id,
        descending: descending,
        page: page,
        sort: sortBy,
        take: rowsPerPage,
        search: this.media.search.query
      }, this.params)

      this.media.loading = true
      this.$http.get(this.media.url, {params: query})
        .then(response => {
          this.media.items = this.merge((response.data.data ? response.data.data : response.data), this.media.selected, 'id')
          this.media.pagination.totalItems = response.data.total
          this.media.loading = false
        })
    },
    search (val) {
      const { sortBy, descending, page, rowsPerPage } = this.media.pagination
      let query = {
        descending: descending,
        page: page,
        sort: sortBy,
        take: rowsPerPage,
        search: val
      }

      this.media.loading = true
      this.$http.get(this.url.search, {params: query})
        .then(response => {
          this.media.items = this.merge(response.data, this.media.selected, 'id')
          this.media.pagination.totalItems = response.data.total
          this.media.loading = false
        })
    },
    select (item) {
      let self = this

      // Toggle Select
      if (item.selected) {
        if (!this.multiple) {
          this.media.items.map(item => {
            item.selected = false
          })
        }
        item.selected = !item.selected
      } else {
        if (!this.multiple) {
          this.media.items.map(item => {
            item.selected = false
          })
        }
        item.selected = true
      }

      // Store to variables
      if (this.multiple) {
        if (item.selected) {
          this.selected.push(item[self.itemValue])
          this.media.selected.push(item)
        } else {
          this.selected.splice(item[self.itemValue], 1)
          this.media.selected.splice(item, 1)
        }
      } else {
        this.selected = null
        this.selected = item[this.itemValue]

        // Also assign to media.selected
        this.media.selected = null
        this.media.selected = item

        if (this.closeOnClick) {
          this.media.box.model = !this.media.box.model
        }
      }

      this.$emit('input', this.selected)
    },
    remove (item) {
      if (this.multiple) {
        this.selected = []
        this.media.selected = []
      } else {
        this.selected = ''
        this.media.selected = null
      }
    },
    menuToggle (menu, url, items) {
      this.menus.upload.model = false
      items = typeof items === 'undefined' ? this.menus.items : items
      items.map(item => {
        item.model = false
      })

      if (menu) {
        menu.model = !menu.model
        this.menus.current = menu
        // this.menus.current.tabmodel = menu.name
      }

      if (url) {
        this.media.url = url
      }
    },
    merge (item1, item2, unique) {
      let updated = JSON.parse(JSON.stringify(this.multiple ? item2 : [item2]))

      if (_isEmpty(item2) || !updated.length) {
        return item1
      }

      for (var i = 0; i < updated.length; i++) {
        let current = updated[i]
        if (this.menus.current.id !== current[this.menuItemId]) {
          updated = updated.filter(u => u !== current)
        }
      }

      return _unionBy(updated, item1, unique)
    }
  },
  mounted () {
    this.get()

    this.menus.items = this.menus.items.concat(this.menuItems)
    // this.menuToggle(this.menus.items[0], this.menus.items[0].url)
  }
}
</script>

<style lang="stylus">
@import '~vuetify/src/stylus/settings/_variables'

.card {
  &__mediabox {
    &--content {
      padding: 0;
    }
  }
}

// Main Content
.sidebar-main-content {
  .data-iterator {
    & > div:first-child {
      height: 100%;
    }
  }
}
.sidebar-main-toolbar {
  width: auto;
}
.sidebar-main-toolbar,
.navigation-drawer + .sidebar-main-content {
  margin-left: 280px;
  box-sizing: border-box;
  transition: .2s cubic-bezier(.4,0,.2,1);
}
.sidebar-main-toolbar--mini-variant,
.navigation-drawer--mini-variant + .sidebar-main-content {
  margin-left: 80px;
  box-sizing: border-box;
}
.card-mediabox-container {
  position: relative;
  overflow: hidden;
  min-height: 140px;

  &.card {
    background-color: #fff !important;
  }

  &.card-shadow-inset {
    box-shadow: inset 0 1px 5px rgba(0,0,0,0.2);
  }

  .card-mediabox-details {
    // position: absolute;
    width: 100%;
    bottom: 0;
    left: 0;
  }

  .card-mediabox-thumbnail {
    height: calc(100% - 52px);
  }
}
.card-mediabox-container img {
  position: relative;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  object-fit: scale-down;
  max-height: 100%;
  max-width: 100%;
  width: 100%;
  height: auto;
}
.card-mediabox-container .stacked {
  position: absolute;
  top: 0;
  left: 0;
  transition: all 0.3s;
  box-sizing: border-box;
  box-shadow: 0px 0px 4px rgba(0,0,0,0.5);
  margin-top: 60px;
  margin-left: 60px;
}
.card-mediabox-container .no-image-caption {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.card-mediabox-container .stacked:first-child {
  margin: 5px;
}
.card-mediabox-container .stacked:last-child {
  position: relative;
}
.card-mediabox-container .stacked:nth-child(2) {
  margin-top: 15px;
  margin-left: 15px;
}
.card-mediabox-container .stacked:nth-child(3) {
  margin-top: 30px;
  margin-left: 30px;
}
.card-mediabox-container .stacked:nth-child(4) {
  margin-top: 45px;
  margin-left: 45px;
}

@media (max-width: $grid-breakpoints.sm) {
  .sidebar-main-toolbar,
  .navigation-drawer + .sidebar-main-content {
    margin-left: 0;
  }
}
</style>
