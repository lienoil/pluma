<template>
    <v-dialog
        v-model="cmOpen"
        fullscreen
        lazy
        transition="dialog-bottom-transition"
        hide-overlay
    >
        <v-card flat tile class="grey lighten-4">
            <v-navigation-drawer v-if="drawer" v-model="drawernav.model" absolute persistent overflow class="grey lighten-3">
                <v-toolbar class="accent lighten-3 white--text">
                    <v-toolbar-title class="subheading" v-if="toolbarLabel" v-html="toolbarLabel"></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn dark icon @click="drawernav.model = !drawernav.model"><v-icon>chevron_left</v-icon></v-btn>
                </v-toolbar>
                <v-list dense class="transparent">
                    <v-list-tile v-for="(item, i) in toolbar.items.category.items" :key="i" @click="toolbarbox().category().select(item)" v-model="item.active">
                        <v-list-tile-action>
                            <v-icon left v-html="item.icon"></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action v-if="item.count">
                            <span v-html="item.count"></span>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
            </v-navigation-drawer>
            <v-toolbar class="accent white--text">
                <v-toolbar-side-icon dark class="grey--text" @click="drawernav.model = !drawernav.model"></v-toolbar-side-icon>
                <slot name="toolbar">
                    <v-menu transition="slide-y-transition" v-if="!drawernav.model">
                        <v-btn flat slot="activator" class="white--text">
                            <v-icon left v-html="toolbar.items.category.selected.icon"></v-icon>
                            <span v-html="toolbar.items.category.selected.name"></span>
                            <v-icon right>arrow_drop_down</v-icon>
                        </v-btn>
                        <v-card>
                            <v-list>
                                <v-list-tile v-for="(item, i) in toolbar.items.category.items" :key="i" @click="toolbarbox().category().select(item)">
                                    <v-list-tile-action>
                                        <v-icon left v-html="item.icon"></v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action v-if="item.count">
                                        <span class="grey--text" v-html="item.count"></span>
                                    </v-list-tile-action>
                                </v-list-tile>
                            </v-list>
                        </v-card>
                    </v-menu>
                </slot>
                <v-spacer></v-spacer>

                <slot name="searchform" :searchform="searchform.query">
                    <v-scale-transition>
                        <v-text-field
                            :append-icon-cb="() => {searchform.model = !searchform.model}"
                            :prefix="searchform.prefix"
                            :prepend-icon="searchform.prepend"
                            append-icon="search"
                            light solo hide-details single-line
                            placeholder="Search"
                            v-model="searchform.query"
                            v-show="searchform.model"
                            transition="scale-transition"
                            @input="searchbox().search(searchform.query, $event)"
                        ></v-text-field>
                    </v-scale-transition>
                    <v-btn transition="scale-transition" v-show="!searchform.model" icon dark @click="searchform.model = !searchform.model"><v-icon>search</v-icon></v-btn>
                </slot>

                <v-btn dark icon @click.stop="dialogbox().close()"><v-icon>close</v-icon></v-btn>

                <v-progress-circular v-if="loading.model" indeterminate class="primary--text"></v-progress-circular>
            </v-toolbar>

            <!-- <v-divider></v-divider> -->

            <main>
                <v-container fluid fill-height grid-list-lg>
                    <template v-if="dataset.items.length === 0">
                        <slot name="empty-result">
                            <v-layout row wrap fill-height>
                                <v-flex>
                                    <div class="text-xs-center grey--text">
                                        <v-icon class="display-4 grey--text">fa-frown-o</v-icon>
                                        <div>There seems to be only loneliness here</div>
                                    </div>
                                </v-flex>
                            </v-layout>
                        </slot>
                    </template>
                </v-container>

                <v-container fluid fill-height grid-list-lg>

                    <v-layout row wrap fill-height>

                        <slot name="content">
                            <v-flex v-for="(dataset, i) in dataset.items" :key="i" sm3>
                                <v-slide-y-transition>
                                    <div class="media--item" role="button" @click.stop="mediabox().select(dataset)">
                                        <!-- @click.stop="computedDataset.select($event, item)" -->
                                        <slot name="media" :item="dataset">
                                            <v-card transition="scale-transition" class="accent" :class="dataset.active?'elevation-10':'elevation-1'">
                                                <v-card-media :height="height" :src="dataset.thumbnail">
                                                    <v-container fill-height fluid class="pa-0 white--text">
                                                        <v-layout column>
                                                            <v-card-title class="subheading" v-html="dataset.name"></v-card-title>
                                                            <v-slide-y-transition>
                                                                <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="dataset.active">check</v-icon>
                                                            </v-slide-y-transition>
                                                            <v-spacer></v-spacer>
                                                            <v-card-actions class="px-2 white--text">
                                                                <v-icon class="white--text" v-html="dataset.icon"></v-icon>
                                                                <v-spacer></v-spacer>
                                                                <span v-html="dataset.mimetype"></span>
                                                                <span v-html="dataset.size"></span>
                                                            </v-card-actions>
                                                        </v-layout>
                                                    </v-container>
                                                </v-card-media>
                                            </v-card>
                                        </slot>
                                    </div>
                                </v-slide-y-transition>
                            </v-flex>
                        </slot>
                    </v-layout>
                </v-container>
            </main>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: 'Mediabox',
        model: {
            prop: 'open'
        },
        props: {
            categories: { type: Array, default: () => { return [] } },
            height: { type: String, default: '250px' },
            closeOnClick: { type: Boolean, default: false },
            multiple: { type: Boolean, default: true },
            drawer: { type: Boolean, default: true },
            old: { type: [Array, Object], default: () => { return [] } },
            open: true,
            toolbarLabel: { type: String, default: '' },
            search: { type: String, default: '' },
            selected: {},
            url: { type: String, default: null },
        },
        data () {
            return {
                dataset: {
                    clone: [],
                    items: [],
                    selected: []
                },
                dialog: {
                    model: false
                },
                drawernav: {
                    model: true
                },
                media: {
                    model: null
                },
                loading: {
                    model: true
                },
                searchform: {
                    prefix: "",
                    prepend: '',
                    model: false,
                    query: null,
                    results: []
                },
                toolbar: {
                    model: true,
                    items: {
                        category: {
                            selected: {},
                            items: [{
                                name: 'All',
                                icon: 'collections',
                                code: 'all',
                                url: '/'
                            }]
                        }
                    }
                }
            }
        },
        computed: {
            cmDataset () {
                return this.dataset
            },

            cmOpen () {
                this.dialog.model = this.open
                return this.dialog.model
            },

            cmUrl () {
                return this.toolbar.items.category.selected
                    ? this.toolbar.items.category.selected.url
                    : this.url
            }
        },
        mounted () {
            this.dialog.model = this.open
            this.loading.model = false

            this.toolbar.items.category.items = this.categories
            this.toolbar.items.category.selected = this.toolbar.items.category.items.length ? this.toolbar.items.category.items[0] : null

            // Searchform mount
            this.searchform.query = this.search

            this.api().get(this.cmUrl, this.toolbar.items.category.selected.query).then(data => {
                this.dataset.selected = this.old
                this.api().dataset().set(data.items)
            })
        },
        methods: {
            api () {
                let self = this

                return {
                    dataset () {
                        return {
                            set (items) {
                                items.map(item => {
                                    item = (typeof item.active == 'undefined') ? Object.assign(item, {active: false}) : item

                                    let index = self.dataset.selected.findIndex((i) => {
                                        let i2 = JSON.parse(JSON.stringify(i)) // clone
                                        let item2 = JSON.parse(JSON.stringify(item)) // clone
                                        i2.active = false
                                        item2.active = false
                                        return JSON.stringify(i2) == JSON.stringify(item2)
                                    });
                                    if (index > -1) {
                                        item.active = true
                                    }
                                })

                                self.dataset.items = items
                                self.dataset.clone = JSON.parse(JSON.stringify(items))

                                self.$emit('set-items', self.dataset.items)
                                return self
                            },

                            get () {
                                self.$emit('get-items', self.dataset.items)

                                return self.dataset.items
                            },

                            select (selected) {

                                if (self.multiple) {
                                    self.api().dataset().multiple(selected)
                                } else {
                                    self.api().dataset().single(selected)
                                }

                                self.$emit('item-selected', self.dataset.selected, self.dataset.items)

                                return self
                            },

                            single (selected) {
                                if (selected.active) {
                                    selected.active = !selected.active
                                    self.api().dataset().unselect(selected)

                                    return
                                }

                                self.dataset.selected = []
                                self.dataset.items.map(item => {
                                    item.active = false
                                })
                                self.api().dataset().multiple(selected)
                            },

                            multiple (selected) {
                                selected.active = !selected.active

                                if (selected.active) {
                                    // Check if exists
                                    self.api().dataset().unselect(selected)
                                    self.dataset.selected.push(selected)
                                } else {
                                    self.api().dataset().unselect(selected)
                                }
                            },

                            unselect (selected) {
                                self.dataset.selected.forEach((item, i) => {
                                    let item2 = JSON.parse(JSON.stringify(item))
                                    let selected2 = JSON.parse(JSON.stringify(selected))
                                    item2.active = false
                                    item2.active = false
                                    if (JSON.stringify(item2) === JSON.stringify(selected2)) {
                                        self.dataset.selected.splice(i, 1)
                                    }
                                })
                            }

                        }
                    },

                    get (url, query) {
                        return new Promise((resolve, reject) => {
                            self.$http.get(url, query).then((response) => {
                                let items = response.body
                                resolve({items})
                            })
                        })
                    }
                }
            },

            toolbarbox () {
                let self = this

                return {
                    select (item, selected) {
                        selected.active = true
                        item = selected

                        return item
                    },
                    category () {
                        return {
                            select (item) {
                                self.toolbar.items.category.items.map(item => {
                                    item.active = false
                                })
                                item.active = true
                                self.toolbar.items.category.selected = item
                                self.api().get(item.url, item.query).then(data => {
                                    self.api().dataset().set(data.items)
                                })
                                self.$emit('category-change', item)
                            }
                        }
                    }
                }
            },

            mediabox () {
                let self = this

                return {
                    select (item) {
                        self.api().dataset().select(item)

                        if (self.closeOnClick && self.dataset.selected.length) {
                            self.dialogbox().toggle()
                        }
                    }
                }
            },

            dialogbox () {
                let self = this

                return {
                    toggle () {
                        self.dialog.model = !self.dialog.model
                    },

                    close () {
                        self.dialog.model = false
                    },

                    open () {
                        self.dialog.model = true
                    }
                }
            },

            searchbox () {
                let self = this

                return {
                    clear () {
                        self.searchbox().search("")
                    },

                    search (query, $event) {
                        self.loading.model = true

                        // self.dataset.items = self.dataset.clone
                        self.api().dataset().set(self.dataset.clone)

                        let specificQuery = query.split(':')
                        if (specificQuery && specificQuery.length > 1) {
                            self.searchform.prepend = "fa-filter"
                        } else {
                            self.searchform.prepend = ""
                        }

                        let items = JSON.parse(JSON.stringify(self.dataset.items))

                        let results = items.filter((o) => {
                            let matches = []
                            Object.entries(o).forEach((key, index) => {
                                if (specificQuery && typeof specificQuery[1] != 'undefined') {
                                    let compare = key[1] !== null ? key[1] : ""
                                    if (key[0].toString().trim().toLowerCase().includes(specificQuery[0].toString().trim().toLowerCase())) {
                                        if (compare.toString().trim().toLowerCase().includes(specificQuery[1].toString().trim().toLowerCase())) {
                                            matches.push(o)
                                        }
                                    }
                                } else {
                                    let compare = key[1] !== null ? key[1] : ""
                                    if (compare.toString().trim().toLowerCase().includes(query.toString().trim().toLowerCase())) {
                                        matches.push(o)
                                    }
                                }
                            })

                            return matches.length //o.name.toLowerCase().includes(query.toLowerCase())
                        })

                        self.dataset.items = results
                        // console.log("Resulrs___________", results)

                        self.loading.model = false
                    }
                }
            }
        },
        watch: {
            'dialog.model': function (value) {
                this.dialog.model = value
                this.$emit('input', value)
            },
            'dataset.selected': function (value) {
                this.dataset.clone.map(item => {
                    item.active = false

                    let index = value.findIndex((i) => {
                        let i2 = JSON.parse(JSON.stringify(i)) // clone
                        let item2 = JSON.parse(JSON.stringify(item)) // clone
                        i2.active = false
                        item2.active = false
                        return JSON.stringify(i2) == JSON.stringify(item2)
                    });
                    if (index > -1) {
                        item.active = true
                    }
                })
                this.$emit('selected', value, this.dataset.items)
            },
            'toolbar.items.category.selected': function (value) {
                // console.log(value.name)
            },
            'search': function (value) {
                this.searchform.query = value
                this.$emit('search', value, this.searchform)
            }
        }
    }
</script>
