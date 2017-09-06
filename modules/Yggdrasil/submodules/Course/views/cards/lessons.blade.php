<template>
    <v-card class="mb-3 elevation-1 grey lighten-4">
        <v-toolbar card dense class="green lighten-3">
            <v-icon class="green--text text--darken-3">fa-leaf</v-icon>
            <v-toolbar-title class="subheading green--text text--darken-3">{{ __('Lessons') }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <template>
                <v-btn
                    icon
                    v-tooltip:left="{'html': '{{ __('Add Lesson') }}'}"
                    @click.native="addSection(draggables.items)"
                >
                    <v-icon>add</v-icon>
                </v-btn>
            </template>
            <template>
                <v-btn
                    icon
                    v-model="lessons.toolbar.modes.distraction.model"
                    v-tooltip:left="{'html': '{{ __('Toggle Distraction-Free Mode') }}'}"
                    @click.native="lessons.toolbar.modes.distraction.model = !lessons.toolbar.modes.distraction.model"
                >
                    <v-icon>@{{ lessons.toolbar.modes.distraction.model ? 'fullscreen_exit' : 'fullscreen' }}</v-icon>
                </v-btn>
            </template>
        </v-toolbar>

        <template v-if="!draggables.items.length">
            <v-card-text class="text-xs-center grey--text mt-5">
                <v-icon x-large>fa-leaf</v-icon>
                <p class="text-xs-center ma-0">{{ __('no lessons planned yet') }}</p>
            </v-card-text>
        </template>

        <v-card-text class="mt-4">
            <draggable class="sortable-container" v-model="draggables.items" :options="{handle: '.parent-handle', group: 'lessons', draggable: '.draggable'}">
                <transition-group>
                    <v-card
                        :key="key"
                        class="draggable elevation-1 mb-2"
                        tile
                        v-for="(draggable, key) in draggables.items"
                        v-model="draggable.active"
                    >
                        {{-- head --}}
                        <v-toolbar card role="button" slot="header" class="light-green lighten-3" dense @click.native="draggable.active = !draggable.active">
                            <div class="sortable-handle parent-handle"><v-icon>drag_handle</v-icon></div>
                            <v-toolbar-title class="subheading">@{{ draggable.resource.title }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon>@{{ draggable.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                            <v-btn icon @click.native="draggables.items.splice(key, 1)"><v-icon>close</v-icon></v-btn>
                        </v-toolbar>

                        {{-- lessons --}}
                        <v-slide-y-transition>
                            <v-card flat tile v-show="draggable.active">
                                <v-layout row wrap>
                                    <v-flex sm3>
                                        <v-card-text>
                                            <input type="hidden" :name="`lessons[${key}][sort]`" :value="key">
                                            <v-text-field
                                                label="{{ __('Lesson Title') }}"
                                                :name="`lessons[${key}][title]`"
                                                v-model="draggable.resource.title"
                                            ></v-text-field>
                                            <v-text-field
                                                label="{{ __('Lesson Description') }}"
                                                :name="`lessons[${key}][description]`"
                                                v-model="draggable.resource.description"
                                            ></v-text-field>
                                        </v-card-text>
                                    </v-flex>
                                    <v-flex sm9 class="grey lighten-3">
                                        <v-toolbar card class="transparent">
                                            <v-toolbar-title class="subheading grey--text text--darken-2">{{ __('Content') }}</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-btn icon class="teal--text text--darken-1" v-tooltip:left="{'html': '{{ __('Add Content') }}'}" @click.native="addSection(draggable.sections)"><v-icon>add</v-icon></v-btn>

                                            <v-btn icon class="teal--text text--darken-1" v-tooltip:left="{'html': '{{ __('Toggle Bulk Commands') }}'}"><v-icon>check_box_outline_blank</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-card
                                            class="mb-2 elevation-1"
                                            tile
                                            v-for="(content, c) in draggable.sections"
                                            :key="c"
                                        >
                                            {{-- head --}}
                                            <v-toolbar card role="button" class="teal lighten-2" dense @click.native="content.active = !content.active">
                                                <div class="sortable-handle"><v-icon>drag_handle</v-icon></div>
                                                <v-toolbar-title class="subheading">@{{ c + 1 }} | @{{ content.resource.title }}</v-toolbar-title>
                                                <v-spacer></v-spacer>
                                                <v-icon>@{{ content.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                                                <v-btn icon @click.native="draggable.sections.splice(c, 1)"><v-icon>close</v-icon></v-btn>
                                            </v-toolbar>

                                            {{-- content --}}
                                            <v-slide-y-transition>
                                                <div v-show="content.active">
                                                    <v-card-text>
                                                        <input type="hidden" :name="`lessons[${key}][content][${c}][sort]`" :value="c">
                                                        <v-text-field
                                                            :name="`lessons[${key}][content][${c}][title]`"
                                                            label="{{ __('Content Title') }}"
                                                            v-model="content.resource.title"
                                                        ></v-text-field>
                                                        <v-text-field
                                                            :name="`lessons[${key}][content][${c}][description]`"
                                                            label="{{ __('Content Description') }}"
                                                            v-model="content.resource.description"
                                                        ></v-text-field>
                                                    </v-card-text>

                                                    <v-card-actions class="teal lighten-3">
                                                        <v-spacer></v-spacer>
                                                        <v-btn small @click.native.stop="mediabox.model = true"><v-icon>perm_media</v-icon>&nbsp;{{ __('Media...') }}</v-btn>
                                                    </v-card-actions>
                                                </div>
                                            </v-slide-y-transition>

                                        </v-card>

                                    </v-flex>
                                </v-layout>
                            </v-card>
                        </v-slide-y-transition>
                    </v-card>
                </transition-group>
            </draggable>
        </v-card-text>
    </v-card>
</template>

@push("mediabox.content")
    <v-tabs dark v-model="mediabox.tabs.active">
        <v-tabs-bar class="accent">
            <v-tabs-item
                key="tab-library"
                href="#tab-library"
                ripple
            >
                {{ __('Library') }}
            </v-tabs-item>
            <v-tabs-item
                key="tab-packages"
                href="#tab-packages"
                ripple
            >
                {{ __('Packages') }}
            </v-tabs-item>
            <v-tabs-item
                key="tab-pages"
                href="#tab-pages"
                ripple
            >
                {{ __('Pages') }}
            </v-tabs-item>
            <v-tabs-item
                key="tab-forms"
                href="#tab-forms"
                ripple
            >
                {{ __('Forms') }}
            </v-tabs-item>
            <v-tabs-slider class="primary"></v-tabs-slider>
        </v-tabs-bar>
    <v-tabs-items>
        <v-tabs-content
            id="tab-packages"
        >
            <v-card flat class="transparent">
                <v-container fluid grid-list-lg>
                    <v-layout row wrap>
                        <template v-for="(media, m) in mediabox.contents.packages">
                            <v-flex sm4>
                                <v-card :key="m" tile accent class="mb-1 elevation-1">
                                    <v-card-text>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error vel mollitia aliquam, ipsum, obcaecati porro commodi incidunt consequatur veniam maxime illum molestias alias veritatis quos velit sed iusto, ut facere?
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </template>
                    </v-layout>
                </v-container>
            </v-card>
        </v-tabs-content>
        <v-tabs-content
            id="tab-pages"
        >
            <v-card flat>
                pages
            </v-card>
        </v-tabs-content>
        <v-tabs-content
            id="tab-forms"
        >
            <v-card flat>
                forms
            </v-card>
        </v-tabs-content>
    </v-tabs-items>

@endpush

@include("Theme::mediabox.media")

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    lessons: {
                        toolbar: {
                            modes: {
                                distraction: {
                                    model: false,
                                },
                            },
                        },
                    },
                    draggables: {
                        items: [],
                    },
                    mediabox: {
                        contents: {
                            packages: [],
                        },
                    },
                };
            },

            methods: {
                addSection (sections) {
                    let c = {
                        id: sections.length + 1,
                        name: '{{ __('Lesson') }}',
                        active: true,
                        resource: {
                            title: 'Untitled #' + (sections.length + 1),
                            code: '',
                        },
                        sections: [],
                    }
                    sections.push(c);
                },

                addContent (key) {
                    this.draggables.items[key].sections.push({count:+1, j: []});
                },
            },

            mounted () {
                getPackages();
            },
        });
    </script>
@endpush
