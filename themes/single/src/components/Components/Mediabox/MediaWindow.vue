<template>
  <v-card flat>

    <!-- Sidebar -->
    <v-navigation-drawer
      class="media-window__sidebar hidden-sm-and-down"
      permanent
      height="100%"
      absolute
      width="280"
      >
      <v-toolbar card color="transparent">
        <v-toolbar-title>{{ trans('Mediabox') }}</v-toolbar-title>
      </v-toolbar>
      <v-list>
        <v-list-tile
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
        <v-btn large color="primary" slot="activator">{{ trans(windowTitle) }}<v-icon right>arrow_drop_down</v-icon></v-btn>
        <v-list>
          <v-list-tile @click="openNewFolderDialog()">
            <v-list-tile-action>
              <v-icon>create_new_folder</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ trans('New folder...') }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
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
          <span>List view</span>
        </v-tooltip>
      </template>
      <template v-else>
        <v-tooltip left>
          <v-btn slot="activator" icon @click="mediawindow.toggleview = 'table'"><v-icon>view_module</v-icon></v-btn>
          <span>Grid view</span>
        </v-tooltip>
      </template>
      <v-btn icon @click="mediawindow.loading = !mediawindow.loading"><v-icon>info</v-icon></v-btn>

      <v-btn class="hidden-sm-and-down" icon @click="closeMediaWindow()"><v-icon>close</v-icon></v-btn>
    </v-toolbar>
    <v-divider></v-divider>
    <v-progress-linear height="2" indeterminate v-show="mediawindow.loading" class="ma-0"></v-progress-linear>

    <v-card-text class="media-window__content">
      <keep-alive>
        <component :is="mediawindow.component"></component>
      </keep-alive>
    </v-card-text>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="primary" @click="closeMediaWindow()">{{ trans('Done') }}</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'MediaWindow',
  model: {
    prop: 'mediawindow.model'
  },
  props: {
    windowIcon: { type: String, default: 'landscape' },
    windowTitle: { type: String, default: 'Mediabox' }
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
      newFolderDialog: {
        model: false
      }
    }
  },
  methods: {
    load (item) {
      this.menus.items.map(item => { item.active = false })
      item.active = true
      this.mediawindow.component = item.component
    },

    closeMediaWindow () {
      this.$emit('input', (this.mediawindow.model = false))
    },

    openNewFolderDialog () {
      this.newFolderDialog.model = !this.newFolderDialog.model
    }
  }
}
</script>

<style lang="stylus">
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
</style>
