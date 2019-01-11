<template>
  <v-navigation-drawer
    :clipped="sidebar.clipped"
    :floating="sidebar.floating"
    :mini-variant.sync="sidebar.mini"
    :dark="sidebar.dark"
    class="sidebar"
    app
    fixed
    v-model="sidebarmodel"
    >
    <!-- Brand -->
    <v-toolbar flat color="transparent">
      <v-list>
        <v-list-tile avatar>
          <v-list-tile-avatar tile>
            <img :src="sidebar.logo" width="40px">
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title><strong v-html="sidebar.title"></strong></v-list-tile-title>
            <v-list-tile-sub-title class="caption" v-html="sidebar.tagline"></v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-btn icon @click="update({dark: !app.dark})"><v-icon>mdi-theme-light-dark</v-icon></v-btn>
    </v-toolbar>
    <!-- Brand -->

    <v-list class="mt-3">
      <!-- TODO: make this recursive -->
      <template v-for="(parent, i) in menus">

        <!-- Menu with children -->
        <template v-if="parent.meta.divider">
          <v-divider :key="i" class="transparent my-2"></v-divider>
        </template>

        <template v-else-if="parent.meta.subheader">
          <v-subheader class="caption" :key="i">{{ (parent.meta.title).toUpperCase() }}</v-subheader>
        </template>

        <template v-else-if="parent.children">
          <v-list-group :key="i" no-action v-model="parent.active">
            <v-icon slot="appendIcon" small>mdi mdi-chevron-down</v-icon>
            <v-list-tile ripple slot="activator" v-model="parent.active">
              <v-list-tile-action>
                <v-icon>{{ parent.meta.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ __(parent.meta.title) }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <!-- Submenu children -->
            <template v-for="(submenu, j) in parent.children">
              <v-divider :key="j" v-if="submenu.meta.divider"></v-divider>
              <template v-else>
                <template v-if="submenu.children">

                </template>
                <template v-else-if="submenu.meta.divider">
                  <v-divider :key="j"></v-divider>
                </template>
                <v-list-tile
                  v-else
                  :key="j"
                  :to="{ name: submenu.name }"
                  :target="submenu.meta.external ? '_blank' : null"
                  exact
                  ripple
                  v-model="submenu.active"
                  >
                  <v-list-tile-content>
                    <v-list-tile-title>{{ trans(submenu.meta.title) }}</v-list-tile-title>
                  </v-list-tile-content>
                  <v-list-tile-action v-hover v-if="submenu.meta.external">
                    <v-icon small>mdi-open-in-new</v-icon>
                  </v-list-tile-action>
                </v-list-tile>
              </template>
            </template>
            <!-- Menu children -->
          </v-list-group>
        </template>
        <!-- Menu with Children -->
        <template v-else>
          <v-list-tile :key="i" ripple v-model="parent.active" exact :to="{name: parent.name}">
            <v-list-tile-action>
              <v-icon>{{ parent.meta.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ trans(parent.meta.title) }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>

      </template>
    </v-list>

  </v-navigation-drawer>
</template>

<script>
import store from '@/store';
import { mapGetters, mapActions } from 'vuex';
import menus from '@/components/Sidebar/config/sidebar';

export default {
  store,

  name: 'Sidebar',

  computed: {
    ...mapGetters({
      sidebar: 'sidebar/sidebar',
      // menus: 'sidebar/menus',
    }),

    menus: function () {
      const page = this.$route;

      menus.map(function (menu) {
        menu.meta.active = page.name === 'course';
      });

      return menus;
    },

    sidebarmodel: {
      set (value) {
        this.toggle({ model: value });
      },
      get () {
        return this.sidebar.model;
      },
    },
  },

  methods: {
    ...mapActions({
      toggle: 'sidebar/toggle',
      clip: 'sidebar/clip',
    }),

    sidebarSetDefaultStateOnMounted(value) {
      switch (this.$root.$vuetify.breakpoint.name) {
        case 'xs':
        case 'sm':
          return this.toggle({ model: false });
        case 'lg':
        default:
          this.toggle({ model: value });
          break;
      }
    },
  },

  mounted () {
    this.sidebarSetDefaultStateOnMounted();
  },
}
</script>
