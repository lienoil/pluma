<template>
  <v-navigation-drawer
    :clipped="$root.sidebar.clipped"
    :dark="$root.theme.dark"
    :floating="$root.sidebar.floating"
    :mini-variant.sync="$root.sidebar.mini"
    app
    transition="slide-x-transition"
    enable-resize-watcher
    class="sidebar sidebar-background"
    v-model="$root.sidebar.model"
    @click.native.stop="localstorage({'single.sidebar.mini': $root.sidebar.mini})">

    <v-toolbar
      class="transparent"
      flat
      >
      <v-list>
        <v-list-tile avatar>
          <v-list-tile-avatar tile>
            <img :src="logo" :alt="title" width="40px">
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title><strong v-html="title"></strong></v-list-tile-title>
            <v-list-tile-sub-title class="caption" v-html="tagline"></v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-toolbar>

    <v-list class="mt-3">
      <template v-for="(menu, i) in menus">
        <!-- Avatar -->
        <v-list-group
          :dark="$root.theme.dark"
          class="mb-5"
          no-action
          v-if="menu.is_avatar"
          v-model="menu.active"
          >
          <v-list-tile ripple avatar slot="activator" v-model="menu.active">
            <v-list-tile-avatar>
              <img :src="menu.labels.avatar">
            </v-list-tile-avatar>
            <v-list-tile-content>
              <v-list-tile-title v-html="menu.labels.name" class="user--displayname"></v-list-tile-title>
              <v-list-tile-sub-title class="caption">
                <v-icon :dark="$root.theme.dark">supervisor_account</v-icon>
                <span v-html="menu.labels.role"></span>
              </v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>

          <template v-for="(submenu, s) in menu.children">
            <v-divider v-if="submenu.is_divider" :dark="$root.theme.dark"></v-divider>
            <v-list-tile v-else ripple exact :href="submenu.url" v-model="submenu.active">
              <v-list-tile-avatar v-if="submenu.icon">
                <v-icon v-html="submenu.icon"></v-icon>
              </v-list-tile-avatar>
              <v-list-tile-content>
                <v-list-tile-title v-html="trans(submenu.labels.title)"></v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list-group>
        <!-- Avatar -->

        <!-- Subheader -->
        <v-subheader
          v-else-if="menu.is_header"
          class="mt-3"
          :dark="$root.theme.dark"
          >
          <strong class="caption" v-html="menu.text.toUpperCase()"></strong>
        </v-subheader>
        <!-- Subheader -->

        <!-- Parent Menu -->
        <v-list-group
          v-else-if="menu.has_children"
          :prepend-icon="menu.icon ? menu.icon : 'widgets'"
          no-action
          ripple
          v-model="menu.active"
          >

          <v-icon slot="appendIcon" small :class="{
            'primary--text': menu.active,
            'grey--text text--darken-2': $root.theme.dark,
            'grey--text text--lighten-2': !$root.theme.dark
          }">keyboard_arrow_down</v-icon>

          <v-list-tile ripple slot="activator" v-model="menu.active">
            <v-list-tile-content>
              <v-list-tile-title v-html="trans(menu.labels.title)"></v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <template v-for="(submenu, s) in menu.children">
            <v-divider
              v-if="submenu.is_divider"
              ></v-divider>

            <!-- We only support up to 3 level deep menus because *reasons* -->
            <template v-else-if="submenu.has_children">
              <v-list-group
                sub-group
                no-group
                v-model="submenu.active"
                >
                <v-list-tile ripple slot="activator" v-model="submenu.active">
                  <v-list-tile-content>
                    <v-list-tile-title v-html="trans(submenu.labels.title)"></v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
                <template v-for="(subgroup, s) in submenu.children">
                  <v-divider
                    v-if="subgroup.is_divider"
                    ></v-divider>
                  <v-list-tile
                    v-else
                    :href="subgroup.url ? subgroup.url : null"
                    :to="subgroup.routename ? {name: subgroup.routename } : null"
                    exact
                    ripple
                    v-model="subgroup.active"
                    >
                    <v-list-tile-content>
                      <v-list-tile-title v-html="trans(subgroup.labels.title)"></v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile-action v-if="subgroup.icon">
                      <v-icon>{{ subgroup.icon }}</v-icon>
                    </v-list-tile-action>
                  </v-list-tile>
                </template>
              </v-list-group>
            </template>

            <v-list-tile
              v-else
              :href="submenu.url ? submenu.url : null"
              :to="submenu.routename ? {name: submenu.routename } : null"
              exact
              ripple
              v-model="submenu.active"
              >
              <v-list-tile-content>
                <v-list-tile-title v-html="trans(submenu.labels.title)"></v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list-group>
        <!-- Parent Menu -->

        <!-- Single Menu -->
        <v-list-tile
          v-else
          :href="menu.url ? menu.url : null"
          :to="menu.routename ? {name: menu.routename} : null"
          exact
          ripple
          v-model="menu.active"
          >
          <v-list-tile-action v-if="menu.icon">
            <v-icon v-html="menu.icon"></v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title v-html="trans(menu.labels.title)"></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <!-- Single Menu -->

      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: 'Sidebar',
  props: {
    items: { type: [Array, Object], default: () => { return [] } },
    title: { type: String, default: '' },
    logo: { type: String, default: '' },
    tagline: { type: String, default: '' }
  },
  computed: {
    current: {
      get () {
        return this.$root.$router.history.current
      }
    },
    menus: {
      get () {
        return Object.keys(this.items).forEach((i) => {
          this.items[i].routeractive = this.current.name === this.items[i].code
        })
      }
    }
  },
  data () {
    return {
      menus: this.items
    }
  }
}
</script>
