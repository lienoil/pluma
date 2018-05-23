<template>
  <v-navigation-drawer v-model="$root.sidebar.model" :dark="$root.theme.dark" app>
    <v-toolbar card :dark="$root.theme.dark" color="transparent">
      <v-toolbar-title class="subheading">Pluma CMS &lt;dev-mode&gt;</v-toolbar-title>
    </v-toolbar>

    <v-list>
      <template v-for="(menu, i) in menus">
        <v-list-group
          :dark.sync="$root.theme.dark"
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
                <v-icon :dark.sync="theme.dark" :light.sync="!theme.dark">supervisor_account</v-icon>
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
                <v-list-tile-title v-html="submenu.labels.title"></v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list-group>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: 'Sidebar',
  props: {
    items: { type: [Array, Object], default: () => { return [] } }
  },
  data () {
    return {
      menus: this.items
    }
  },
  mounted () {
    console.log(this.menus, this.items)
  }
}
</script>
