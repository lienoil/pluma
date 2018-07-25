<template>
  <v-card flat>
    <!-- Sidebar -->
    <v-navigation-drawer
      absolute
      class="media-window__sidebar hidden-sm-and-down"
      height="100%"
      permanent
      width="280"
      >
      <v-list>
        <v-list-tile
          :key="i"
          @click="load(menu)"
          v-for="(menu, i) in menus.items"
          v-model="menu.active"
          >
          <v-list-tile-action>
            <v-icon>{{ menu.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ trans(menu.title) }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <!-- Sidebar -->

    <v-toolbar card class="media-window__toolbar">
      <v-btn
        @click="$root.localstorage('single.media.window.sidebar.mini', (mediawindow.sidebar.mini = !mediawindow.sidebar.mini))"
        class="hidden-sm-and-down"
        icon
        ripple
        >
        <v-icon>menu</v-icon>
      </v-btn>

      <!-- New Menu -->
      <v-menu>
        <v-btn
          large
          color="primary"
          slot="activator"
          >
          {{ trans(windowTitle) }}
          <v-icon right>arrow_drop_down</v-icon>
        </v-btn>
        <v-list>

          <v-dialog v-model="newfolder.model" full-width lazy max-width="320px">
            <v-list-tile slot="activator" @click="">
              <v-list-tile-action>
                <v-icon>create_new_folder</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ trans('New folder...') }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-card>
              <v-card-title>{{ trans('Create new folder') }}</v-card-title>
              <v-card-text>
                <v-text-field v-model="folder.new.name" :label="trans('Folder name')" hide-details v-focus @keyup.enter="createNewFolder" @focus="$event.target.select()"></v-text-field>
                <v-combobox v-model="folder.new.foldertype" :label="trans('Folder type')" hide-details :items="folder.foldertypes">
                  <template
                    slot="item"
                    slot-scope="{ index, item, parent }"
                    >
                    <v-list-tile-action>
                      <component :is="`${item.value}Icon`"></component>
                    </v-list-tile-action>
                    <v-list-tile-content>
                      <v-list-tile-title>{{ item.text }}</v-list-tile-title>
                    </v-list-tile-content>
                  </template>
                </v-combobox>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn flat @click="cancelNewFolder">{{ trans('Cancel') }}</v-btn>
                <v-btn color="primary" depressed @click="createNewFolder">{{ trans('Create') }}</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>

          <v-divider></v-divider>
          <v-list-tile @click="openNewFolderDialog()">
            <v-list-tile-action>
              <v-icon>create_new_folder</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ trans('Upload files...') }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile @click="openNewFolderDialog()">
            <v-list-tile-action>
              <v-icon>create_new_folder</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ trans('Upload folder...') }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
      <!-- New Menu -->

      <v-spacer class="hidden-sm-and-down"></v-spacer>

      <template v-if="mediawindow.toggleview === 'table'">
        <v-tooltip left>
          <v-btn slot="activator" icon @click="mediawindow.toggleview = 'grid'"><v-icon>list</v-icon></v-btn>
          <span>{{ trans('List view') }}</span>
        </v-tooltip>
      </template>
      <template v-else>
        <v-tooltip left>
          <v-btn slot="activator" icon @click="mediawindow.toggleview = 'table'"><v-icon>view_module</v-icon></v-btn>
          <span>{{ trans('Grid view') }}</span>
        </v-tooltip>
      </template>

      <template>
        <v-tooltip left>
          <v-btn slot="activator" icon @click="toggle('details-view')" v-model="mediabox.toolbar.details.model"><v-icon>info</v-icon></v-btn>
          <span>{{ trans('Toggle details pane') }}</span>
        </v-tooltip>
      </template>

      <template>
        <v-tooltip left>
          <v-btn slot="activator" class="hidden-sm-and-down" icon @click="closeMediaWindow()"><v-icon>close</v-icon></v-btn>
          <span>{{ trans('Close this window') }}</span>
        </v-tooltip>
      </template>
    </v-toolbar>

    <v-divider></v-divider>

    <v-progress-linear height="2" :indeterminate="mediawindow.loading" class="media-window__progress-linear"></v-progress-linear>

    <v-card-text class="media-window__content">
      <keep-alive>
        <component :is="mediawindow.component"></component>
      </keep-alive>
    </v-card-text>

    <v-divider></v-divider>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="primary" @click="select()">{{ trans('Done') }}</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import store from './store'
import { mapGetters } from 'vuex'

export default {
  store,

  name: 'MediaWindow',

  model: {
    prop: 'mediawindow.model'
  },

  props: {
    windowIcon: { type: String, default: 'landscape' },
    windowTitle: { type: String, default: 'Mediabox' }
  },

  computed: {
    ...mapGetters({
      mediabox: 'mediabox/mediabox',
      mediawindow: 'mediawindow/mediawindow',
      mediathumbnail: 'mediathumbnail/mediathumbnail',
      folder: 'folder/folder',
    }),
  },

  data () {
    return {
      mediawindow: {
        model: true,
        sidebar: {
          mini: false
        },
        toggleview: 'grid',
        loading: false,
        component: () => import('./partials/MainMediaWindow')
      },

      menus: {
        current: 'main',
        items: [
          { active: true, code: 'main', icon: this.windowIcon, title: this.windowTitle, component: () => import('./partials/MainMediaWindow') },
          { active: false, code: 'recent', icon: 'access_time', title: 'Recent', component: () => import('./partials/RecentMediaWindow') },
          { active: false, code: 'trash', icon: 'delete', title: 'Trash', component: () => import('./partials/TrashMediaWindow') }
        ]
      },

      newfolder: {
        model: false,
        item: {
          name: 'New Folder',
          foldertype: {text: null, value: null},
        }
      },
    }
  },
  methods: {
    select () {
      let item = this.mediathumbnail.item
      this.$store.dispatch('mediawindow/toggle', {model: false})
      this.$emit('open', item)
    },

    load (item) {
      this.menus.items.map(item => { item.active = false })
      item.active = true
      this.mediawindow.component = item.component
    },

    toggle (view) {
      switch (view) {
        case 'details-view':
          this.$store.dispatch('mediabox/toolbar', {
            toolbar: {
              details: {
                model: !this.mediabox.toolbar.details.model
              }
            }
          })
          break
      }
    },

    closeMediaWindow () {
      this.$emit('input', (this.mediawindow.model = false))
    },

    // Folder Management
    openNewFolderDialog () {
      this.newFolderDialog.model = !this.newFolderDialog.model
    },
    createNewFolder () {
      this.newfolder.model = false
      this.$store.dispatch('folder/create', this.folder.new)
    },
    cancelNewFolder () {
      this.newfolder.model = false
    }
  }
}
</script>

<style lang="stylus" scoped>
.media-window {
  &__toolbar,
  &__content {
    width: auto;
    margin-left: 280px;
  }
  &__content {
    padding: 0;
  }

}
.media-window__progress-linear {
  margin: 0;
  background-color: transparent;
}
</style>
