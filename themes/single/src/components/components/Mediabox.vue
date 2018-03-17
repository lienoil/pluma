<template>
  <v-card class="card-mediabox">
    <v-toolbar card v-if="!hideToolbar">
      <v-icon v-html="icon"></v-icon>
      <v-toolbar-title class="body-2" v-html="title"></v-toolbar-title>
    </v-toolbar>
    <v-card flat tile class="card-mediabox-container image-transparent" ripple :height="height" role="button" @click.native="media.box.model = !media.box.model">
      <template v-if="(selected instanceof Array) && selected.length !== 0">
        <slot name="thumbnail" :props="{item: media.selected}">
          <img class="stacked" v-for="(s, i) in selected" :key="i" :src="s">
        </slot>
      </template>
      <template v-else-if="typeof selected === 'string' && selected">
        <slot name="thumbnail" :props="{item: media.selected, src: selected}">
          <img :src="selected">
        </slot>
      </template>
      <template v-else>
        <slot name="no-image-text" :props="{text: noImageText}">
          <p class="grey--text text-xs-center no-image-caption" v-html="noImageText"></p>
        </slot>
      </template>
    </v-card>
    <slot name="thumbnail-details" :props="{item: media.selected, src: selected}"></slot>
    <v-card-actions v-if="!hideActions">
      <v-btn v-if="selected.length !== 0" ref="mediabox-clear-button" flat @click="remove(selected)">Remove</v-btn>
      <v-spacer></v-spacer>
      <v-btn ref="mediabox-browser-button" flat @click="media.box.model = ! media.box.model">{{ selected.length === 0 ? 'Browse' : 'Change' }}</v-btn>
    </v-card-actions>

    <!-- Dialog -->
    <template>
      <v-dialog class="white" v-model="media.box.model" max-width="100%" lazy scrollable persistent>
        <v-card height="90vh" :dark="$root.theme.dark" :light="!$root.theme.dark">

          <v-toolbar card :dark="$root.theme.dark" :light="!$root.theme.dark" class="sidebar-main-toolbar" :class="{'sidebar-main-toolbar--mini-variant': media.sidebar.mini}">
            <v-btn icon class="hidden-sm-and-down" ripple @click="$root.localstorage('single.media.sidebar.mini', (media.sidebar.mini = !media.sidebar.mini))"><v-icon>{{ media.sidebar.mini ? 'chevron_right' : 'chevron_left' }}</v-icon></v-btn>
            <!-- <v-icon class="hidden-sm-and-down grey--text" left>{{ menus.current.icon }}</v-icon>
            <v-toolbar-title class="hidden-sm-and-down subheading grey--text" v-html="menus.current.name"></v-toolbar-title>
            <v-spacer class="hidden-sm-and-down"></v-spacer> -->
            <v-text-field class="mx-3" prepend-icon="search" v-model="media.search.query" v-bind="{'solo': !$root.theme.dark, 'solo-inverted': $root.theme.dark}" label="Search"></v-text-field>

            <v-spacer class="hidden-sm-and-down"></v-spacer>

            <template v-if="media.toggleview === 'table'">
              <v-tooltip left>
                <v-btn slot="activator" icon @click="media.toggleview = 'grid'"><v-icon>list</v-icon></v-btn>
                <span>List view</span>
              </v-tooltip>
            </template>
            <template v-else>
              <v-tooltip left>
                <v-btn slot="activator" icon @click="media.toggleview = 'table'"><v-icon>view_module</v-icon></v-btn>
                <span>Grid view</span>
              </v-tooltip>
            </template>
            <v-btn icon @click="media.loading = !media.loading"><v-icon>info</v-icon></v-btn>

            <v-btn class="hidden-sm-and-down" icon @click="media.box.model = false"><v-icon>close</v-icon></v-btn>
            <!-- <template slot="extension">
              <v-spacer></v-spacer>
              <template v-if="media.toggleview === 'table'">
                <v-tooltip left>
                  <v-btn slot="activator" icon @click="media.toggleview = 'grid'"><v-icon>list</v-icon></v-btn>
                  <span>List view</span>
                </v-tooltip>
              </template>
              <template v-else>
                <v-tooltip left>
                  <v-btn slot="activator" icon @click="media.toggleview = 'table'"><v-icon>view_module</v-icon></v-btn>
                  <span>Grid view</span>
                </v-tooltip>
              </template>
              <v-btn icon @click="media.loading = !media.loading"><v-icon>info</v-icon></v-btn>
            </template> -->
          </v-toolbar>

          <v-divider></v-divider>

          <v-card-text class="pa-0">
            <v-tabs v-model="menus.current.tabmodel" icons-and-text centered class="hidden-sm-and-up" :dark="$root.theme.dark" :light="!$root.theme.dark">
              <v-tabs-slider color="primary"></v-tabs-slider>
              <v-tab
                :key="menu.name"
                ripple
                v-for="(menu, i) in menus.items"
                @click="menuToggle(menu, menu.url)"
              >
                {{ menu.name }}
                <v-icon v-html="menu.icon"></v-icon>
              </v-tab>
              <v-tab
                :key="menus.upload.name"
                ripple
                @click="menuToggle(menus.upload)"
              >
                {{ menus.upload.name }}
                <v-icon v-html="menus.upload.icon"></v-icon>
              </v-tab>
            </v-tabs>
            <v-divider class="hidden-sm-and-up"></v-divider>
            <v-navigation-drawer class="hidden-sm-and-down" :dark="$root.theme.dark" :light="!$root.theme.dark" permanent height="100%" :mini-variant="media.sidebar.mini" absolute width="280">
              <v-list :dark="$root.theme.dark" :light="!$root.theme.dark">
                <v-list-tile>
                  <v-list-tile-action>
                    <v-icon>{{ icon }}</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ title }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
              <!-- <v-divider></v-divider> -->
              <v-list class="pt-0">
                <v-subheader>New</v-subheader>
                <v-list-tile v-model="menus.upload.model" @click="menuToggle(menus.upload)">
                  <v-list-tile-action>
                    <v-icon>{{ menus.upload.icon }}</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ menus.upload.name }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <slot name="menus" :props="{ menus: menus.items, toggle: (b, u) => { menuToggle(b, u) } }">
                  <v-list-tile v-model="menu.model" v-for="(menu, i) in menus.items" :key="i" @click="menuToggle(menu, menu.url)">
                    <v-list-tile-action>
                      <v-icon>{{ menu.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                      <v-list-tile-title>{{ menu.name }}</v-list-tile-title>
                    </v-list-tile-content>
                  </v-list-tile>
                </slot>
              </v-list>
            </v-navigation-drawer>

            <v-slide-y-transition mode="in-out">
              <v-card v-if="menus.upload.model" flat :dark="$root.theme.dark" :light="!$root.theme.dark" height="calc(100vh - 191px)" class="sidebar-main-content transparent">
                <v-card-text>
                  <upload class="elevation-0" :categories="menus.items"></upload>
                </v-card-text>
              </v-card>
            </v-slide-y-transition>

            <v-slide-y-transition mode="out-in">
              <v-card v-if="!menus.upload.model" flat height="calc(100vh - 191px)" class="sidebar-main-content transparent">
                <v-data-table
                  v-if="media.toggleview === 'table'"
                  :headers="media.headers"
                  :items="media.items"
                  :loading="media.loading"
                  :no-data-text="noMediaText"
                  :pagination.sync="media.pagination"
                  :rows-per-page-items="media.pagination.rowsPerPageItems"
                  :rows-per-page-text="media.pagination.rowsPerPageText"
                  :search="media.search.query"
                  :total-items="media.pagination.totalItems"
                  v-model="selected"
                >
                  <template slot="items" slot-scope="props">
                    <tr :class="{'primary white--text': props.item.selected}" @click="select(props.item)" role="button">
                      <td>
                        <v-avatar size="30px" class="mr-3"><img :src="props.item[itemValue]"></v-avatar>
                        <span v-html="props.item[itemText]"></span>
                      </td>
                      <td>
                        <v-btn slot="activator" icon color="white">
                          <v-icon color="red" v-html="props.item[itemIcon]"></v-icon>
                        </v-btn>
                        <span v-html="props.item[itemMimetype]"></span>
                      </td>
                      <td v-html="props.item[itemSize]"></td>
                      <td v-html="props.item[itemDate]"></td>
                    </tr>
                  </template>
                </v-data-table>

                <v-container v-if="media.toggleview === 'grid'" fluid grid-list-lg>
                  <v-data-iterator
                    :items="media.items"
                    :loading="media.loading"
                    :no-data-text="noMediaText"
                    :pagination.sync="media.pagination"
                    :rows-per-page-items="media.pagination.rowsPerPageItems"
                    :rows-per-page-text="media.pagination.rowsPerPageText"
                    :search="media.search.query"
                    :total-items="media.pagination.totalItems"
                    content-tag="v-layout"
                    row wrap
                    select-all="accent"
                    v-model="selected"
                  >
                    <v-flex
                      slot="item"
                      slot-scope="props"
                      xs12 sm6 md4 lg2
                    >
                      <v-card tile ripple hover height="100%" @click.native="select(props.item)" :class="{'primary white--text': props.item.selected}" light>
                        <v-card-media contain class="image-transparent" height="180px" :src="props.item[itemValue]"></v-card-media>
                        <v-card-actions>
                          <v-tooltip bottom>
                            <v-btn slot="activator" icon color="white"><v-icon color="red" v-html="props.item[itemIcon]"></v-icon></v-btn>
                            <span v-html="props.item[itemMimetype]"></span>
                          </v-tooltip>
                          <span class="body-2" v-html="props.item[itemText]"></span>
                        </v-card-actions>
                      </v-card>
                    </v-flex>
                  </v-data-iterator>

                </v-container>
              </v-card>
            </v-slide-y-transition>

          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" flat @click="media.box.model = !media.box.model">Done</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
    <!-- Dialog -->
  </v-card>
</template>

<script>
import Upload from './Upload.vue'

export default {
  props: {
    closeOnClick: { type: Boolean, default: true },
    headers: { type: Array, default: () => { return [] } },
    height: { type: String, default: 'auto' },
    hideActions: { type: Boolean, default: false },
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
    multiple: { type: Boolean, default: false },
    noImageText: { type: String, default: 'No image selected' },
    noMediaText: { type: String, default: 'No media found' },
    title: { type: String, default: 'Mediabox' },
    uploadText: { type: String, default: 'Upload' },
    url: { type: Object, default: () => { return { all: '/', search: '/' } } }
  },
  model: {
    prop: 'selected'
  },
  components: { Upload },
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
        items: [
          { id: null, name: 'All Media', icon: 'image', model: true, url: this.url.all }
        ]
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
      let query = {
        catalogue_id: this.menus.current.catalogue_id,
        descending: descending,
        page: page,
        sort: sortBy,
        take: rowsPerPage,
        search: this.media.search.query
      }

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

      // for (var i = 0; i < updated.length; i++) {
      //   let current = updated[i]

      //   if (this.menus.current.id !== current[this.menuItemId]) {
      //     updated.splice(i, 1)
      //   }
      // }

      if (this._.isEmpty(updated)) {
        return item1
      }

      return this._.unionBy(updated, item1, unique)
    }
  },
  mounted () {
    this.get()

    this.menus.items = this.menus.items.concat(this.menuItems)
    this.menuToggle(this.menus.items[0], this.menus.items[0].url)
  }
}
</script>

<style lang="stylus">
@import '~vuetify/src/stylus/settings/_variables'

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
  padding: 5px;
  overflow: hidden;
  min-height: 180px;
  box-shadow: inset 0 1px 5px rgba(0,0,0,0.2);
}
.card-mediabox-container img {
  position: absolute;
  display: block;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  max-height: 100%;
  max-width: 100%;
  width: auto;
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
