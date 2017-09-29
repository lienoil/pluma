<template>
    <v-navigation-drawer dark enable-resize-watcher persistent overflow>
        <v-list dense>
            <v-list-tile v-for="(item, i) in items" :key="i">
                <v-icon>edit</v-icon>
                <v-list-tile-title v-html="item.title"></v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    export default {
        name: 'sidebar',
        model: {
            prop: 'items',
        },
        props: {
            items: []
        },
        data () {
            return {
                dataset: {
                    items: [],
                }
            }
        },
        mounted () {
            this.dataset.items = this.items
        },
        watch: {
            'items': function (items) {
                this.$emit('input', items);
            }
        }
    }
</script>

<style scoped>
    /**/
</style>
