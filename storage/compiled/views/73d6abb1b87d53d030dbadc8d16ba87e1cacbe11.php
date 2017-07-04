<v-toolbar fixed class="white">
    <v-toolbar-side-icon dark @click.native.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>{{ application.head.title }}</v-toolbar-title>
    <v-toolbar-side-icon dark @click.native.stop="dark = !dark"></v-toolbar-side-icon>
</v-toolbar>
