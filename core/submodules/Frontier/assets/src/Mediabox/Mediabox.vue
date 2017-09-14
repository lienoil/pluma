<template>
    <v-dialog
        v-model="dialog.model"
        fullscreen
        lazy
        transition="dialog-bottom-transition"
        hide-overlay
    >
        <slot name="activator">
            <v-btn icon ripple slot="activator"><v-icon>perm_media</v-icon></v-btn>
        </slot>
        <v-card flat tile class="card--mediabox grey lighten-4">
            <slot name="toolbar">
                <v-toolbar card dark class="accent">
                    <v-progress-circular v-if="loading.model" indeterminate class="primary--text"></v-progress-circular>
                    <v-icon v-if="!loading.model" dark left>{{ toolbar.selected.icon }}</v-icon>
                    <v-menu :nudge-width="100">
                        <v-toolbar-title slot="activator">
                            <span>{{ toolbar.selected.title }}</span>
                            <v-icon dark right>arrow_drop_down</v-icon>
                        </v-toolbar-title>
                        <v-list>
                            <v-list-tile v-for="item in toolbar.items" :key="item.code" @click="toolbar.selected = item">
                                <v-list-tile-action>
                                    <v-icon left v-html="item.icon"></v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                                </v-list-tile-content>
                                <v-list-tile-action>

                                    <span class="grey--text" v-html="item.count"></span>
                                </v-list-tile-action>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                    <v-spacer></v-spacer>
                    <v-btn icon ripple><v-icon dark>search</v-icon></v-btn>
                    <v-btn
                        :class="toolbar.buttons.gridlist.model ? 'btn--active' : ''"
                        icon
                        @click.native="toolbar.buttons.gridlist.model = !toolbar.buttons.gridlist.model"
                    ><v-icon>{{ toolbar.buttons.gridlist.model ? 'view_module' : 'list' }}</v-icon></v-btn>

                    <v-btn icon ripple @click.native="dialog.model = !dialog.model"><v-icon dark>close</v-icon></v-btn>
                </v-toolbar>
            </slot>
            <slot name="content">
                <v-layout row wrap fill-height>
                    <template v-for="(set, i) in dataset.items" :key="i">
                        <v-flex sm6>
                            <v-card class="elevation-1">
                                <v-card-text>
                                    {{ set.name }}
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </template>
                </v-layout>
            </slot>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "Mediabox",
        data () {
            return {
                dialog: {
                    model: true,
                },
                loading: {
                    model: true,
                },
                dataset: {
                    items: [],
                },
                toolbar: {
                    selected: { title: 'All', icon: 'perm_media' },
                    items: [],
                    buttons: {
                        gridlist: {
                            model: true,
                        },
                    },
                },
            };
        },

        props: {
            toolbarItems: {
                type: Array,
                default: () => {
                    return [{ count: '', title: 'All', code: 'all', icon: 'perm_media', url: '' }];
                }
            },
        },

        computed: {
            computedToolbarItems () {
                let toolbarItems = this.toolbarItems;
                return toolbarItems;
            },
        },

        methods: {
            initToolbarItems () {
                this.toolbar.items = this.computedToolbarItems;
            },

            setLoading (loading) {
                let self = this;
                setTimeout(function () {
                    self.loading.model = loading;
                }, 2000);
            },

            getDataset (url) {
                let self = this;
                return new Promise((resolve, reject) => {
                    self.$http.get(url).then((response) => {
                        let items = response.body;
                        resolve({items});
                    });
                });
            }
        },

        mounted () {
            let self = this;

            this.setLoading(false);
            this.initToolbarItems();

            this.getDataset(item.url).then(items => {
                self.dataset.items = items;
            });
        },

        watch: {
            'toolbar.selected': function (item) {
                let self = this;
                self.$emit('item-change', item);

                this.getDataset(item.url).then(items => {
                    self.dataset.items = items;
                });
            }
        }
    }
</script>

<style>

</style>
