<v-toolbar
    :class="theme.utilitybar"
    class="elevation-1 grey--text"
    :dark.sync="light" :light.sync="dark"
    fixed
>
    <v-toolbar-side-icon class="grey--text" @click.native.stop="drawer = !drawer">
        <v-icon :dark.sync="dark" :light.sync="light">@{{ drawer?'account_box':'chevron_left' }}</v-icon>
    </v-toolbar-side-icon>
    <v-toolbar-title>{{ $application->page->title }}</v-toolbar-title>
    <v-spacer></v-spacer>
    @stack("utilitybar")
</v-toolbar>
