<template>
    <v-card class="elevation-1 grey lighten-4" :class="lessons.toolbar.modes.distraction.model?'mode-distraction-free mb-0':'mb-3'">
        <v-toolbar card dense class="white lighten-3" :class="lessons.toolbar.modes.distraction.model?'mode-distraction-free--toolbar elevation-3':''">
            <v-icon class="green--text text--darken-3">fa-leaf</v-icon>
            <v-toolbar-title class="subheading green--text text--darken-3">{{ __('Lessons') }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <template>
                {{-- Add --}}
                <v-btn
                    icon
                    v-tooltip:left="{'html': '{{ __('Add Lesson') }}'}"
                    @click.native.stop="addSection(draggables.items)"
                >
                    <v-icon>add</v-icon>
                </v-btn>

                {{-- Expand --}}
                <v-btn
                    icon
                    v-tooltip:left="{'html': '{{ __('Expand / compress') }}'}"
                    @click.native.stop="toolbar().expand().toggle(draggables.items)"
                >
                    <v-icon small>@{{ lessons.toolbar.expand.model ? 'fa-expand' : 'fa-compress'}}</v-icon>
                </v-btn>
            </template>
            <template>
                <v-btn
                    icon
                    v-model="lessons.toolbar.modes.distraction.model"
                    v-tooltip:left="{'html': '{{ __('Toggle Distraction-Free Mode') }}'}"
                    @click.native.stop="lessons.toolbar.modes.distraction.model = !lessons.toolbar.modes.distraction.model"
                >
                    <v-icon>@{{ lessons.toolbar.modes.distraction.model ? 'fullscreen_exit' : 'fullscreen' }}</v-icon>
                </v-btn>
            </template>
        </v-toolbar>


        <v-card-text :class="lessons.toolbar.modes.distraction.model?'pa-5 mt-5':''">
            <template v-if="!draggables.items.length">
                <v-card-text role="button" v-tooltip:top="{'html': '{{ __('Add lesson') }}'}" class="text-xs-center grey--text my-5" @click="addSection(draggables.items)">
                    <v-icon x-large>fa-leaf</v-icon>
                    <p class="text-xs-center ma-0">{{ __('no lessons planned yet') }}</p>
                </v-card-text>
            </template>
            <draggable v-if="draggables.items.length" class="sortable-container" v-model="draggables.items" :options="{animation: 150, handle: '.parent-handle', group: 'lessons', draggable: '.draggable-lesson', forceFallback: true}">
                <transition-group>
                    <v-card
                        :key="key"
                        class="draggable-lesson elevation-1 mb-3"
                        tile
                        v-for="(draggable, key) in draggables.items"
                        v-model="draggable.active"
                    >
                        {{-- head --}}
                        <div class="green lighten-4" style="height: 3px;"></div>
                        <v-toolbar card slot="header" class="sortable-handle parent-handle white lighten-3" dense @click.native.stop="draggable.active = !draggable.active">
                            <v-icon>drag_handle</v-icon>
                            <v-spacer></v-spacer>
                            <v-toolbar-title class="subheading">@{{ draggable.resource.title }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon>@{{ draggable.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                            <v-btn icon @click.native.stop="draggables.items.splice(key, 1)"><v-icon>close</v-icon></v-btn>
                        </v-toolbar>

                        {{-- lessons --}}
                        <v-slide-y-transition>
                            <v-card flat tile v-if="draggable.active">
                                <v-layout row wrap>
                                    <v-flex sm12>
                                        <v-card-text>
                                            <input type="hidden" :name="`lessons[${key}][sort]`" :value="key">
                                            <v-text-field
                                                label="{{ __('Lesson Title') }}"
                                                :name="`lessons[${key}][title]`"
                                                v-model="draggable.resource.title"
                                            ></v-text-field>
                                        </v-card-text>

                                        {{-- Quill --}}
                                        <quill :id="`lessons-${key}-editor`" v-model="draggable.resource.quill" class="mb-3 white" :fonts="['Montserrat', 'Roboto']">
                                            <template>
                                                <input type="hidden" :name="`lessons[${key}][body]`" :value="draggable.resource.quill.html">
                                                <input type="hidden" :name="`lessons[${key}][delta]`" :value="JSON.stringify(draggable.resource.quill.delta)">
                                            </template>
                                        </quill>
                                        {{-- /Quill --}}

                                    </v-flex>
                                </v-layout>
                                <v-layout row wrap>
                                    <v-flex sm12 class="grey lighten-3">
                                        <v-toolbar card class="transparent">
                                            <v-toolbar-title class="subheading grey--text text--darken-2">{{ __('Content') }}</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <v-btn icon class="grey--text text--darken-2" v-tooltip:left="{'html': '{{ __('Add Content') }}'}" @click.native.stop="addSection(draggable.sections)"><v-icon>add</v-icon></v-btn>

                                            <v-btn icon class="grey--text text--darken-2" v-tooltip:left="{'html': '{{ __('Toggle Bulk Commands') }}'}"><v-icon>check_box_outline_blank</v-icon></v-btn>
                                        </v-toolbar>

                                        <template v-if="!draggable.sections.length">
                                            <v-card-text
                                                class="text-xs-center grey--text ma-2"
                                                ripple
                                                role="button"
                                                @click.stop="addSection(draggable.sections)">
                                                <v-icon x-large>add</v-icon>
                                                <p class="text-xs-center ma-0">{{ __('add content') }}</p>
                                            </v-card-text>
                                        </template>

                                        <draggable v-if="draggable.sections.length" class="sortable-container pa-1" v-model="draggable.sections" :options="{animation: 150, handle: '.sortable-handle', group: 'contents', draggable: '.draggable-child', forceFallback: true}">
                                            <transition-group>
                                                <v-card
                                                    class="draggable-child mb-2 elevation-1"
                                                    tile
                                                    v-for="(content, c) in draggable.sections"
                                                    :key="c">
                                                    {{-- head --}}
                                                    <div class="amber lighten-4" style="height: 3px;"></div>
                                                    <v-toolbar card role="button" class="sortable-handle white" dense @click.native.stop="content.active = !content.active">
                                                        <v-icon>drag_handle</v-icon>
                                                        {{-- <v-checkbox hide-details color="yellow" v-model="content.model"></v-checkbox> --}}
                                                        <v-spacer></v-spacer>
                                                        <v-toolbar-title class="subheading">@{{ content.resource.title }}</v-toolbar-title>
                                                        <v-spacer></v-spacer>
                                                        <v-icon>@{{ content.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                                                        <v-btn icon @click.native.stop="draggable.sections.splice(c, 1)"><v-icon>close</v-icon></v-btn>
                                                    </v-toolbar>

                                                    {{-- Content --}}
                                                    <v-slide-y-transition>
                                                        <div v-if="content.active">
                                                            <v-card-text>
                                                                <input type="hidden" :name="`lessons[${key}][contents][${c}][sort]`" :value="c">
                                                                <v-text-field
                                                                    :name="`lessons[${key}][contents][${c}][title]`"
                                                                    label="{{ __('Content Title') }}"
                                                                    v-model="content.resource.title"
                                                                ></v-text-field>
                                                            </v-card-text>

                                                            {{-- Quill --}}
                                                            <quill :id="`lessons-${key}-contents-${c}-editor`" v-model="content.resource.quill" class="mb-3 white" :fonts="['Montserrat', 'Roboto']">
                                                                <template>
                                                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][body]`" :value="content.resource.quill.html">
                                                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][delta]`" :value="JSON.stringify(content.resource.quill.delta)">
                                                                </template>
                                                            </quill>
                                                            {{-- /Quill --}}

                                                            {{-- Interactive Content --}}
                                                            <v-card-text class="grey lighten-4">
                                                                <p class="subheading grey--text">{{ __('Interactive Content') }}</p>
                                                                <template v-if="!content.resource.interactive">
                                                                    <v-card-text
                                                                        class="grey lighten-3 text-xs-center grey--text py-5"
                                                                        ripple
                                                                        role="button"
                                                                        @click.stop="content.mediabox = !content.mediabox">
                                                                        <v-icon x-large>movie</v-icon>
                                                                        <p class="text-xs-center ma-0">{{ __('add interactive content') }}</p>
                                                                    </v-card-text>
                                                                </template>
                                                                {{-- Preview --}}
                                                                <v-fade-transition>
                                                                    <v-card
                                                                        class="elevation-1"
                                                                        role="button"
                                                                        transition="fade-transition"
                                                                        v-if="content.resource.interactive"
                                                                        @click.stop="content.mediabox = !content.mediabox">
                                                                        <v-card-media :src="content.resource.interactive.thumbnail" height="230px">
                                                                            <v-container fill-height fluid class="pa-0 white--text">
                                                                                <v-layout column>
                                                                                    <v-card-actions>
                                                                                        <v-card-title v-html="content.resource.interactive.name"></v-card-title>
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn
                                                                                            icon
                                                                                            dark
                                                                                            @click.stop="content.resource.interactive = null"><v-icon>close</v-icon>
                                                                                        </v-btn>
                                                                                    </v-card-actions>
                                                                                    <v-spacer></v-spacer>
                                                                                    <v-card-actions>
                                                                                        <v-icon left class="white--text" v-html="content.resource.interactive.icon"></v-icon>
                                                                                        <span v-html="content.resource.interactive.mime"></span>
                                                                                        <v-spacer></v-spacer>
                                                                                        <span v-html="content.resource.interactive.filesize"></span>
                                                                                        <input type="hidden" :name="`lessons[${key}][contents][${c}][library_id]`" :value="content.resource.interactive.id">
                                                                                        <input type="hidden" :name="`lessons[${key}][contents][${c}][interactive]`" :value="JSON.stringify(content.resource.interactive)">
                                                                                    </v-card-actions>
                                                                                </v-layout>
                                                                            </v-container>
                                                                        </v-card-media>
                                                                    </v-card>
                                                                </v-fade-transition>
                                                                {{-- /Preview --}}
                                                            </v-card-text>
                                                            <v-card-actions class="grey lighten-4">
                                                                <v-spacer></v-spacer>
                                                                <mediabox :toolbar-items="[
                                                                        {code:'all', count:100,title:'All',icon:'perm_media', url: '{{ route('api.library.all') }}' },
                                                                        {code:'albums', count:69,title:'Albums',icon:'album'},
                                                                        {code:'collections', count:99,title:'Collections',icon:'collections'},
                                                                    ]"
                                                                    :open="content.mediabox"
                                                                    url="{{ route('api.library.all') }}"
                                                                    v-model="content.resource.interactive">
                                                                    <template slot="item" scope="props">
                                                                        <v-card-media :src="props.item.thumbnail" height="200px">
                                                                            <v-container fill-height fluid class="pa-0 white--text">
                                                                                <v-layout column>
                                                                                    <v-slide-y-transition>
                                                                                        <v-icon ripple class="display-4 pa-4 success--text" v-if="props.item.active">check</v-icon>
                                                                                    </v-slide-y-transition>
                                                                                    <v-card-title>@{{ props.item.originalname }}</v-card-title>
                                                                                    <v-spacer></v-spacer>
                                                                                    <v-card-actions>
                                                                                        <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                                                                                        <v-spacer></v-spacer>
                                                                                        <span>@{{ props.item.mime }}</span>
                                                                                        <span>@{{ props.item.filesize }}</span>
                                                                                    </v-card-actions>
                                                                                </v-layout>
                                                                            </v-container>
                                                                        </v-card-media>
                                                                    </template>
                                                                </mediabox>
                                                            </v-card-actions>
                                                            {{-- Interactive Content --}}
                                                        </div>
                                                    </v-slide-y-transition>

                                                </v-card>
                                            </transition-group>
                                        </draggable>

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

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/dist/mediabox/Mediabox.css') }}">
@endpush
@php
    echo "<pre>";
        var_dump( old('lessons') );
    echo "</pre>";
@endphp
@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script src="{{ assets('frontier/dist/mediabox/Mediabox.js') }}"></script>
    <script>
        Vue.use(Mediabox);

        mixins.push({
            components: { Mediabox },
            data () {
                return {
                    lessons: {
                        toolbar: {
                            modes: {
                                distraction: {
                                    model: false,
                                },
                            },
                            expand: {
                                model: false,
                            }
                        },
                    },
                    draggables: {
                        items: [],
                        old: [],
                    },
                };
            },

            events: {
                //
            },

            watch: {
                'content.resource.interactive': function (val) {
                   //
                }
            },

            methods: {
                toolbar () {
                    let self = this;
                    return {
                        expand () {
                            return {
                                toggle (togglables) {
                                    self.lessons.toolbar.expand.model = !self.lessons.toolbar.expand.model;
                                    for (var i = 0; i < togglables.length; i++) {
                                        let current = togglables[i];
                                        current.active = ! current.active;
                                    }
                                }
                            }
                        }
                    }
                },

                addSection (sections) {
                    let c = {
                        id: sections.length + 1,
                        name: '{{ __('Lesson') }}',
                        active: true,
                        resource: {
                            title: 'Untitled #' + (sections.length + 1),
                            code: '',
                            quill: {},
                            interactive: null,
                        },
                        mediabox: false,
                        sections: [],
                    }
                    sections.push(c);
                },

                updateSection (sections, values) {
                    console.log(values);
                    sections.push({
                        id: values.id,
                        name: values.name,
                        active: true,
                        resource: {
                            title: values.title,
                            code: values.code,
                            quill: {
                                html: values.body,
                                delta: JSON.parse(values.delta),
                            },
                            // interactive: null,
                        },
                        mediabox: false,
                        sections: [],
                    });
                },

                close (origin, options) {
                    console.log("mediabox-origin", origin);
                },

                old () {
                    let olds = {!! json_encode(old('lessons')) !!};
                    if (olds) {
                        for (var i = 0; i < olds.length; i++) {
                            let current = olds[i];
                            this.updateSection(this.draggables.items, current);

                            if (current.contents) {
                                for (var j = 0; j < current.contents.length; j++) {
                                    let c = current.contents[j];
                                    this.updateSection(this.draggables.items[i].sections, c);
                                }
                            }
                        }
                    }
                },
            },

            mounted () {
                this.old();
            },
        });
    </script>
@endpush
