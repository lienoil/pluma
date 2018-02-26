<v-toolbar light app scroll-off-screen>
  <v-toolbar-side-icon color="grey--text" @click="localstorage('single.sidebar.model', sidebar.model = ! sidebar.model)"></v-toolbar-side-icon>
  <v-spacer></v-spacer>
  <v-btn icon ripple @click="rightsidebar.model = ! rightsidebar.model"><v-icon color="grey">keyboard_arrow_left</v-icon></v-btn>
</v-toolbar>
