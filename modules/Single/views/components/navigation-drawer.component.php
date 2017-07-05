<v-navigation-drawer persistent :mini-variant.sync="mini" v-model="drawer" :dark.sync="dark" :light.sync="light">
    <v-list class="pa-0">
        <v-list-item>
            <v-list-tile avatar tag="div">
                <v-list-tile-avatar>
                    <img src="http://deepaelectronics.co.in/images/00205-3D-art-logo-design-free-logos-online-011.png">
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>@{{ application.site.title }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn icon @click.native.stop="mini = !mini" :dark.sync="light" :light.sync="dark">
                        <v-icon>chevron_left</v-icon>
                    </v-btn>
                </v-list-tile-action>
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
        @include("Single::templates.sidebar")
    </v-list>

    <v-divider :dark.sync="dark" :light.sync="light"></v-divider>

</v-navigation-drawer>
