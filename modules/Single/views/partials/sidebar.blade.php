<v-navigation-drawer class="pb-0" permanent absolute height="100%" dark>
    <v-list dense>
        <v-layout row align-center>
            <v-flex xs6>
                <v-subheader>
                    @{{ application.site.title }}
                </v-subheader>
            </v-flex>
        </v-layout>
        <v-layout row align-center>
            <v-flex xs6>
                <v-subheader>
                    TODO: Subheader
                </v-subheader>
            </v-flex>
        </v-layout>

        @include("Single::templates.navigations.sidebar")
    </v-list>
</v-navigation-drawer>
