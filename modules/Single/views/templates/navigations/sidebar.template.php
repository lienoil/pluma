<template v-for="(item, i) in sidebar">
    <!-- if -->
    <v-layout row v-if="item.is_header" align-center :key="i">
        <v-flex xs6>
            <v-subheader v-if="item.is_header" light>
                @{{ item.labels.title }}
            </v-subheader>
        </v-flex>
        <v-flex xs6 class="text-xs-center" light>
            <!-- <a href="#!" class="body-2 black--text">EDIT</a> -->
        </v-flex>
    </v-layout>

    <!-- else if -->
    <v-divider dark v-else-if="item.divider" class="my-4" :key="i"></v-divider>

    <!-- else -->
    <v-list-group no-action v-else>
        <v-list-item slot="item">
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon light>@{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        @{{ item.labels.title }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-item>

        <!-- else if -->
        <template v-if="item.children" v-model="true" no-action>
            <v-list-item v-for="(child, i) in item.children" :key="i">
                <v-list-tile>
                    <v-list-tile-action v-if="child.icon">
                        <v-icon>@{{ child.icon }}</v-icon>
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
