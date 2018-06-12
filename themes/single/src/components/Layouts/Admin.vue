<template>
  <v-app :dark="theme.dark">
    <sidebar
      :title="app.title"
      :logo="app.logo"
      :items="navigations.sidebar"
      >
    </sidebar>

    <v-toolbar light fixed app scroll-off-screen appear transition="slide-y-transition">
      <v-toolbar-side-icon color="grey--text" @click="localstorage('sidebar.mini', sidebar.mini = ! sidebar.mini)"></v-toolbar-side-icon>
      <v-spacer></v-spacer>
      <v-btn icon ripple @click="rightsidebar.model = ! rightsidebar.model"><v-icon color="grey">keyboard_arrow_left</v-icon></v-btn>
    </v-toolbar>


    <v-content>
      <v-divider></v-divider>
      <router-view></router-view>
    </v-content>

    <v-footer app inset absolute height="auto">
      <v-container fluid>
        <v-layout row wrap>
          <v-flex tag="small" class="grey--text" v-html="app.footer.copyright"></v-flex>
          <v-spacer></v-spacer>
          <v-flex tag="small" class="grey--text text-xs-right" justify-end v-html="app.version"></v-flex>
        </v-layout>
      </v-container>
    </v-footer>
  </v-app>
</template>

<script>
window.i18n = {}

export default {
  name: 'Admin',
  data () {
    return {
      app: {
        title: 'Pluma CMS',
        logo: '/static/logo.png',
        footer: '',
        version: 'v3.0.0'
      },
      navigations: {
        sidebar: []
      }
    }
  }
}
</script>
