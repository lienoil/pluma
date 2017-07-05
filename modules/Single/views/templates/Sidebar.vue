<template>
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

<script type="text/babel">
    import Sidebar from './Sidebar.vue'

    export default {
        name: 'sidebar',

        components: {
            SidebarC: Sidebar
        },

        props: {
            model: Array,
        }

    }
</script>
