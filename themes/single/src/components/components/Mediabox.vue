<template>
  <v-card class="card-mediabox">
    <v-toolbar card class="transroot">
      <v-icon v-html="icon"></v-icon>
      <v-toolbar-title class="body-2 grey--text text--darken-2" v-html="title"></v-toolbar-title>
    </v-toolbar>
    <div class="card-mediabox-container grey lighten-3">
      <template v-if="(selected instanceof Array) && selected.length !== 0">
        <img class="stacked" width="100%" height="auto" v-for="(s, i) in selected" :key="i" :src="s">
      </template>
      <template v-else-if="typeof selected === 'string' && selected">
        <img width="100%" height="auto" :src="selected">
      </template>
      <template v-else>
        <p class="grey--text text-xs-center no-image-caption">No image selected</p>
      </template>
    </div>
    <v-card-actions>
      <v-btn v-if="selected.length !== 0" ref="mediabox-clear-button" flat @click="remove(selected)">Remove</v-btn>
      <v-spacer></v-spacer>
      <v-btn ref="mediabox-browser-button" flat @click="media.box.model = ! media.box.model">{{ selected.length === 0 ? 'Browse' : 'Change' }}</v-btn>
    </v-card-actions>

    <!-- Dialog -->
    <template>
      <v-dialog class="white" v-model="media.box.model" max-width="100%" lazy scrollable persistent>
        <v-card height="90vh">
          <v-toolbar :dark="$root.theme.dark" :light="!$root.theme.dark" card class="sidebar-main-toolbar" :class="{'sidebar-main-toolbar--mini-variant': media.sidebar.mini}">
            <v-btn icon @click.stop="media.sidebar.mini = !media.sidebar.mini"><v-icon>{{ media.sidebar.mini ? 'chevron_right' : 'chevron_left' }}</v-icon></v-btn>
            <v-text-field prepend-icon="search" v-model="media.search.query" v-bind="{'solo': !$root.theme.dark, 'solo-inverted': $root.theme.dark}" label="Search"></v-text-field>
            <v-spacer></v-spacer>
            <v-btn icon @click="media.box.model = false"><v-icon>close</v-icon></v-btn>
          </v-toolbar>
          <v-card-text>
            <v-navigation-drawer :dark="$root.theme.dark" :light="!$root.theme.dark" permanent height="100%" :mini-variant="media.sidebar.mini" absolute width="280">
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
              <v-list>
                <v-list-tile v-model="menus.upload.model" @click="menuToggle(menus.upload)">
                  <v-list-tile-action>
                    <v-icon>{{ menus.upload.icon }}</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ menus.upload.name }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <v-subheader>Filters</v-subheader>
                <v-list-tile v-model="menu.model" v-for="(menu, i) in menus.items" :key="i" @click="menuToggle(menu)">
                  <v-list-tile-action>
                    <v-icon>{{ menu.icon }}</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content>
                    <v-list-tile-title>{{ menu.name }}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <slot name="menus" :props="{ menus, toggle: (b) => { menuToggle(b) } }"></slot>
              </v-list>
            </v-navigation-drawer>

            <v-slide-y-transition>
              <v-card v-if="menus.upload.model" flat height="100vh" class="sidebar-main-content grey lighten-3">
                <v-card-text></v-card-text>
              </v-card>
            </v-slide-y-transition>

            <v-slide-y-transition>
              <v-card v-if="!menus.upload.model" flat height="100vh" class="sidebar-main-content">
                <v-container fluid>
                  <v-data-iterator
                    :items="media.items"
                    :loading="media.loading"
                    :pagination.sync="media.pagination"
                    :rows-per-page-items="media.pagination.rowsPerPageItems"
                    :rows-per-page-text="media.pagination.rowsPerPageText"
                    :search="media.search.query"
                    :total-items="media.pagination.totalItems"
                    content-tag="v-layout"
                    row wrap
                    no-data-text="No Media Found"
                    select-all
                  >
                    <v-flex
                      slot="item"
                      slot-scope="props"
                      xs12 sm6 md4 lg3
                    >
                      <v-card tile ripple hover @click.native="select(props.item)" v-model="props.selected">
                        <v-card-media class="accent" height="180px" :src="props.item[itemValue]"></v-card-media>
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
export default {
  props: {
    closeOnClick: { default: true },
    icon: { default: 'landscape' },
    itemText: { default: 'text' },
    itemValue: { default: 'value' },
    multiple: { default: false },
    title: { default: 'Mediabox' },
    uploadText: { default: 'Upload' },
    url: { default: () => { return { all: '', search: '' } } }
  },
  model: {
    prop: 'selected'
  },
  data () {
    return {
      selected: [],
      media: {
        box: { model: false },
        items: [],
        loading: true,
        search: { query: '' },
        sidebar: { model: false, mini: false },
        url: this.url.all,
        pagination: {
          rowsPerPageItems: [5, 10, 25, {'text': 'All', 'value': -1}],
          rowsPerPageText: 'Items per page:',
          totalItems: 10
        }
      },
      menus: {
        upload: { name: 'Upload', icon: 'cloud_upload', model: false },
        items: [
          { name: 'All Media', icon: 'image', model: true, url: this.url.all }
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
    }
  },
  methods: {
    get () {
      const { sortBy, descending, page, rowsPerPage } = this.media.pagination
      let query = {
        descending: descending,
        page: page,
        sort: sortBy,
        take: rowsPerPage,
        search: this.media.search.query
      }

      this.media.loading = true
      this.$http.get(this.media.url, {params: query})
        .then(response => {
          this.media.items = response.data
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
          this.media.items = response.data
          this.media.pagination.totalItems = response.data.total
          this.media.loading = false
        })
    },
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
    },
    remove (item) {
      if (this.multiple) {
        this.selected = []
      } else {
        this.selected = ''
      }
    },
    menuToggle (menu) {
      this.menus.upload.model = false
      this.menus.items.map(item => {
        item.model = false
      })
      menu.model = !menu.model
      if (menu.url) {
        this.media.url = menu.url
      }
    }
  },
  mounted () {
    this.get()
  }
}
</script>

<style scoped>
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
  min-height: 90px;
  box-shadow: inset 0 1px 5px rgba(0,0,0,0.2);
}
.card-mediabox-container img {
  display: block;
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
</style>
