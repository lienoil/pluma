<v-toolbar light fixed app scroll-off-screen appear transition="slide-y-transition">
  <v-toolbar-side-icon color="grey--text" @click="localstorage('sidebar.mini', sidebar.mini = ! sidebar.mini)"></v-toolbar-side-icon>
  <v-spacer></v-spacer>
  <v-btn icon ripple @click="rightsidebar.model = ! rightsidebar.model"><v-icon color="grey">keyboard_arrow_left</v-icon></v-btn>
</v-toolbar>
