<template>
    <v-dialog
        v-model="dialog.model"
        fullscreen
        lazy
        transition="dialog-bottom-transition"
        hide-overlay
    >
        <slot name="activator"></slot>
        <v-card flat tile class="card--mediabox grey lighten-4">
            <slot name="toolbar">
                <v-toolbar fixed dark class="accent">
                    <v-progress-circular v-if="loading.model" indeterminate class="primary--text"></v-progress-circular>

                    <v-menu :nudge-width="100">
                        <v-btn flat slot="activator">
                            <v-icon v-if="!loading.model" dark left>{{ toolbar.selected.icon }}</v-icon>
                            <span>{{ toolbar.selected.title }}</span>
                            <v-icon dark right>arrow_drop_down</v-icon>
                        </v-btn>
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
                    <slot name="selected-text">
                        <span v-if="dataSelected && multiple">{{ dataSelected.length }} Selected</span>
                        <v-spacer></v-spacer>
                    </slot>
                    <v-btn icon ripple><v-icon dark>search</v-icon></v-btn>
                    <v-btn
                        :class="toolbar.buttons.gridlist.model ? 'btn--active' : ''"
                        icon
                        @click.native="toolbar.buttons.gridlist.model = !toolbar.buttons.gridlist.model"
                    ><v-icon>{{ toolbar.buttons.gridlist.model ? 'view_module' : 'list' }}</v-icon></v-btn>

                    <v-btn icon ripple @click.native="dialogbox().close()"><v-icon dark>close</v-icon></v-btn>
                </v-toolbar>
            </slot>

            <v-toolbar card></v-toolbar>
            <v-divider></v-divider>

            <slot name="content" :dataset="computedDataset">
                <v-container fluid fill-height grid-list-lg>
                    <v-layout row wrap fill-height class="pt-4">
                        <template v-for="(item, i) in computedDataset.items" :key="i">
                            <v-flex>
                                <v-scale-transition>
                                    <v-card tile class="mediabox-item" :class="item.active?'mediabox-item--active elevation-10':'elevation-1'" role="button" @click.stop="computedDataset.select($event, item)">
                                        <slot name="item" :item="item">
                                            <v-card-title>
                                                {{ item.name }}
                                            </v-card-title>
                                            <v-card-actions class="grey--text">
                                                <v-icon color="green" v-if="item.active">check</v-icon>
                                                <v-spacer></v-spacer>
                                                <span>{{ item.mime }}</span>
                                                <span>{{ item.type }}</span>
                                            </v-card-actions>
                                        </slot>
                                    </v-card>
                                </v-scale-transition>
                            </v-flex>
                        </template>
                    </v-layout>
                </v-container>
            </slot>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: "Mediabox",
        model: {
            prop: 'selected',
        },
        data () {
            return {
                dialog: {
                    model: false,
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
                dataSelected: [],
            };
        },

        props: {
            selected: null,
            toolbarItems: {
                type: Array,
                default: () => {
                    return [{ count: '', title: 'All', code: 'all', icon: 'perm_media', url: '' }];
                }
            },
            items: { type: Array, default: () => { return []; } },
            url: { type: String, default: '/' },
            multiple: { type: Boolean, default: false },
            timeout: { type: Number, default: 200 },
            open: { type: Boolean, default: false },
        },

        computed: {
            computedToolbarItems () {
                let toolbarItems = this.toolbarItems;
                return toolbarItems;
            },

            computedDataset () {
                let self = this;
                let dataset = this.dataset;

                dataset.select = function ($event, selected) {
                    self.mediabox().select($event, selected);
                }

                return dataset;
            },
        },

        methods: {
            init () {
                this.$emit('initialize');
                this.dialog.model = this.open;
                this.initToolbarItems();
            },

            initToolbarItems () {
                this.toolbar.items = this.computedToolbarItems;
            },

            setLoading (loading) {
                let self = this;
                setTimeout(function () {
                    self.loading.model = loading;
                }, 1000);
            },

            getDataset (url) {
                let self = this;
                return new Promise((resolve, reject) => {
                    self.$http.get(url).then((response) => {
                        let items = response.body;
                        resolve({items});
                    });
                });
            },

            mediabox () {
                let self = this;
                return {
                    select ($event, selected) {
                        let isMultiple = self.multiple;

                        if (isMultiple) {
                            if (selected.active) {
                                selected.active = false;
                                self.dataSelected.splice(selected, 1);
                                self.$emit('input', self.dataSelected);
                                self.$emit('mediabox-selected', self.dataSelected);
                                return;
                            }
                            selected.active = true;
                            self.dataSelected.push(selected);
                        } else {
                            if (selected.active) {
                                // unselect
                                selected.active = false;
                                self.dataSelected = null;
                            } else {
                                self.dataset.items.map(function (item) {
                                    item.active = false;
                                });
                                selected.active = true;
                                self.dataSelected = selected;
                            }
                        }

                        self.$emit('input', self.dataSelected);
                        self.$emit('mediabox-selected', self.dataSelected);
                        self.dialogbox().toggle();
                    }
                };
            },

            dialogbox () {
                let self = this;
                return {
                    toggle () {
                        setTimeout(function () {
                            self.dialog.model = !self.dialog.model;
                        }, self.timeout);
                    },

                    close () {
                        self.dialog.model = false;
                    }
                }
            },
        },

        mounted () {
            let self = this;

            this.setLoading(true);
            this.init();
            this.getDataset(this.url).then(data => {
                self.dataset.items = data.items;
                self.setLoading(false);
            });
        },

        watch: {
            'toolbar.selected': function (item) {
                let self = this;
                self.$emit('item-change', item);
                if (item.url) {
                    this.getDataset(item.url).then(data => {
                        self.dataset.items = data.items;

                        self.dataset.items.map(function (item) {
                            let index = self.dataSelected.findIndex((_tem) => _tem.id == item.id);
                            if (index > -1) {
                                item.active = true;
                            }
                        });
                    });
                } else {
                    self.dataset.items = [];
                }
            },

            'open': function (val) {
                this.dialog.model = this.open;
                console.log(this.open, this.dialog.model, val);
                this.$emit('open', val);
                this.$emit('input', !val);
            },

            'dialog.model': function (val) {
                console.log("dm", val)
                // this.dialog.model = !this.dialog.model;
            }
        }
    }
</script>

<style>
    .mediabox-item {
        transition: box-shadow 0.2s ease-in-out;
    }
    .mediabox-item--active {
        border: 1px solid inherit;
    }
</style>
