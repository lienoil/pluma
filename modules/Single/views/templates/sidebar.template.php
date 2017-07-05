<template v-for="(item, i) in sidebar">
    <!-- if -->
    <v-layout row v-if="item.is_header" align-center :key="i">
        <v-flex xs6>
            <v-subheader v-if="item.is_header" :dark.sync="light" :light.sync="dark">
                @{{ item.labels.title }}
            </v-subheader>
        </v-flex>
        <v-flex xs6 class="text-xs-center" :dark.sync="dark" :light.sync="light">
            <!-- <a href="#!" class="body-2 black--text">EDIT</a> -->
        </v-flex>
    </v-layout>

    <!-- else if -->
    <v-divider :dark.sync="dark" :light.sync="light" v-else-if="item.divider" class="my-4" :key="i"></v-divider>

    <!-- else -->
    <v-list-group no-action v-else :model="item.children">
        <v-list-item slot="item">
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon :dark.sync="light" :light.sync="dark">@{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        @{{ item.labels.title }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-item>

        <!-- if -->
        <template v-if="item.children">
            <v-list-item v-for="(child, i) in item.children" :item="child" :key="i">
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon v-if="child.icon" :dark.sync="light" :light.sync="dark">@{{ child.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            @{{ child.labels.title }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list-item>
        </template>
    </v-list-group>
</template>
