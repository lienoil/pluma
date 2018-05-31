<template>
  <v-navigation-drawer
    :clipped="$root.sidebar.clipped"
    :dark.sync="$root.theme.dark"
    :floating="$root.sidebar.floating"
    :light.sync="!$root.theme.dark"
    :mini-variant.sync="$root.sidebar.mini"
    app
    transition="slide-x-transition"
    enable-resize-watcher
    class="sidebar sidebar-background"
    v-model="$root.sidebar.model"
    @click.native.stop="localstorage({'single.sidebar.mini': $root.sidebar.mini})">

    <v-toolbar flat class="transparent">
      <v-list>
        <v-list-tile avatar>
          <v-list-tile-avatar>
            <img :src="logo" :alt="title" width="40px">
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title><strong v-html="title"></strong></v-list-tile-title>
            <v-list-tile-sub-title class="caption" v-html="tagline"></v-list-tile-sub-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-btn ripple icon :dark.sync="$root.theme.dark" :light.sync="!$root.theme.dark" @click="localstorage({'single.sidebar.mini': ($root.sidebar.mini = !$root.sidebar.mini)})">
              <v-icon :dark.sync="$root.theme.dark" :light.sync="!$root.theme.dark">chevron_left</v-icon>
            </v-btn>
          </v-list-tile-action>
        </v-list-tile>
      </v-list>
    </v-toolbar>

    <v-divider></v-divider>

    <v-list>
      <template v-for="(menu, i) in $root.navigations.sidebar">
        <v-list-group
          :dark.sync="$root.theme.dark" :light.sync="!$root.theme.dark"
          class="mb-4"
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
                <v-icon :dark.sync="$root.theme.dark" :light.sync="!$root.theme.dark">supervisor_account</v-icon>
                <span v-html="menu.labels.role"></span>
              </v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>

          <template v-for="(submenu, s) in menu.children">
            <v-divider v-if="submenu.is_divider"></v-divider>
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

        <v-subheader v-else-if="menu.is_header" :dark.sync="$root.theme.dark" :light.sync="!$root.theme.dark">
          <small v-html="menu.text.toUpperCase()"></small>
          &nbsp;<v-divider :dark.sync="$root.theme.dark" :light.sync="!$root.theme.dark"></v-divider>
        </v-subheader>

        <v-list-group v-else-if="menu.has_children" lazy ripple no-action v-model="menu.active" :prepend-icon="menu.icon ? menu.icon : 'widgets'">
          <v-list-tile ripple slot="activator" v-model="menu.active">
            <v-list-tile-content>
              <v-list-tile-title v-html="trans(menu.labels.title)"></v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <template v-for="(submenu, s) in menu.children">
            <v-divider v-if="submenu.is_divider"></v-divider>
            <v-list-tile v-else ripple exact v-model="submenu.active" :to="submenu.routename ? {name: submenu.routename } : null" :href="submenu.url ? submenu.url : null">
              <v-list-tile-content>
                <v-list-tile-title v-html="trans(submenu.labels.title)"></v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list-group>

        <v-list-tile v-else ripple exact v-model="menu.active" :to="menu.routename ? menu.routename : null" :href="menu.url ? menu.url : null">
          <v-list-tile-action v-if="menu.icon">
            <v-icon v-html="menu.icon"></v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title v-html="trans(menu.labels.title)"></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

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
  data () {
    return {
      menus: this.items
    }
  },
  mounted () {
    // console.log(this.menus, this.items)
  }
}
</script>
