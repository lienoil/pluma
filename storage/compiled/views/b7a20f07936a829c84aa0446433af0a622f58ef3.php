<v-toolbar fixed class="white">
    <v-toolbar-side-icon @click.native.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>{{ application.head.title }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
        <v-toolbar-item>
            <v-switch class="mt-3" v-model="theme" @click.native.stop="light=!light;dark=!dark"></v-switch>
        </v-toolbar-item>
    </v-toolbar-items>
</v-toolbar>
