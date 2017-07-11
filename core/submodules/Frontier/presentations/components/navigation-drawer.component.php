<v-navigation-drawer persistent :mini-variant.sync="mini" v-model="drawer" :dark.sync="dark" :light.sync="light">
    <v-list class="pa-0">
        <v-list-item>
            <v-list-tile tag="div">
                <!-- @include("Frontier::partials.brand") -->
            </v-list-tile>
        </v-list-item>
    </v-list>

    <!-- <v-divider :dark.sync="dark" :light.sync="light"></v-divider> -->

    <v-list>
        <v-list-group no-action class="blue-grey lighten-1">
            <v-list-item slot="item" role="button">
                <v-list-tile avatar tag="div">
                    <v-list-tile-avatar>
                        <img src="https://randomuser.me/api/portraits/men/99.jpg">
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>@{{ user.displayname }}</v-list-tile-title>
                        <span><small>@{{ user.roles }}</small></span>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list-item>
            <v-list-item>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon light>account_box</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title :route='{"path": "/url"}'><small>Account</small></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list-item>
        </v-list-group>
    </v-list>

    <v-list dense>
        @include("Frontier::templates.sidebar")
    </v-list>

    <v-divider :dark.sync="dark" :light.sync="light"></v-divider>

</v-navigation-drawer>
