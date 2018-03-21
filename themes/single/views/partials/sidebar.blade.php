<v-navigation-drawer
  :clipped="sidebar.clipped"
  :dark.sync="theme.dark"
  :floating="sidebar.floating"
  :light.sync="!theme.dark"
  :mini-variant.sync="sidebar.mini"
  app
  class="sidebar"
  v-model="sidebar.model"
  @click.native.stop="localstorage('single.sidebar.mini', sidebar.mini)">

  <image-overlay v-model="sidebar.withBackground" :src="sidebar.style.background"></image-overlay>

  <v-toolbar flat class="transparent">
    <v-list>
      <v-list-tile avatar>
        <v-list-tile-avatar>
          <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}" width="40px">
        </v-list-tile-avatar>
        <v-list-tile-content>
          <v-list-tile-title><strong>{{ $application->site->title }}</strong></v-list-tile-title>
          <v-list-tile-sub-title class="caption">{{ $application->site->tagline }}</v-list-tile-sub-title>
        </v-list-tile-content>
        <v-list-tile-action>
          <v-btn ripple icon :dark.sync="theme.dark" :light.sync="!theme.dark" @click="localstorage('single.sidebar.mini', sidebar.mini = ! sidebar.mini)">
            <v-icon :dark.sync="theme.dark" :light.sync="!theme.dark" class="grey--text lighten-2">chevron_left</v-icon>
          </v-btn>
        </v-list-tile-action>
      </v-list-tile>
    </v-list>
  </v-toolbar>

  <v-divider></v-divider>

  <v-list>
    <template v-for="(menu, i) in navigations.sidebar">
      {{-- Avatar --}}
      <v-list-group
        :dark.sync="theme.dark" :light.sync="!theme.dark"
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
      {{-- Avatar --}}

      {{-- Header --}}
      <v-subheader v-else-if="menu.is_header" :dark.sync="theme.dark" :light.sync="!theme.dark">
        <small v-html="menu.text.toUpperCase()"></small>
        &nbsp;<v-divider :dark.sync="theme.dark" :light.sync="!theme.dark"></v-divider>
      </v-subheader>
      {{-- Header --}}

      {{-- Has Children --}}
      <v-list-group v-else-if="menu.has_children" ripple no-action v-model="menu.active" :prepend-icon="menu.icon ? menu.icon : 'widgets'">
        <v-list-tile ripple slot="activator" v-model="menu.active">
          <v-list-tile-content>
            <v-list-tile-title v-html="menu.labels.title"></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        {{-- Child --}}
        <template v-for="(submenu, s) in menu.children">
          <v-divider v-if="submenu.is_divider"></v-divider>
          <v-list-tile v-else ripple exact v-model="submenu.active" :to="{name: submenu.routename ? submenu.routename : submenu.name}">
            <v-list-tile-content>
              <v-list-tile-title v-html="submenu.labels.title"></v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        {{-- Child --}}
      </v-list-group>
      {{-- Has Children --}}

      {{-- Single --}}
      <v-list-tile v-else ripple exact v-model="menu.active" :to="menu.routename ? menu.routename : null" :href="menu.url ? menu.url : null">
        <v-list-tile-avatar v-if="menu.icon">
          <v-icon v-html="menu.icon"></v-icon>
        </v-list-tile-avatar>
        <v-list-tile-content>
          <v-list-tile-title v-html="menu.labels.title"></v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
      {{-- Single --}}

    </template>
  </v-list>
</v-navigation-drawer>
