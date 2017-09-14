<template>
    <v-card class="mb-3 elevation-1 grey lighten-4" :class="lessons.toolbar.modes.distraction.model?'distraction-free-mode':''">
        <v-toolbar card dense class="white lighten-3" :class="lessons.toolbar.modes.distraction.model?'distraction-free-mode--toolbar elevation-3':''">
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
            <v-card-text role="button" v-tooltip:top="{'html': '{{ __('Add lesson') }}'}" class="text-xs-center grey--text mt-5" @click="addSection(draggables.items)">
                <v-icon x-large>fa-leaf</v-icon>
                <p class="text-xs-center ma-0">{{ __('no lessons planned yet') }}</p>
            </v-card-text>
        </template>

        <v-card-text class="mt-4" :class="lessons.toolbar.modes.distraction.model?'pt-4':''">
            <draggable v-model="draggables.items" :options="{animation: 150, handle: '.parent-handle', group: 'lessons', draggable: '.draggable'}">
                <transition-group>
                    <v-card
                        :key="key"
                        class="draggable elevation-1 mb-2"
                        tile
                        v-for="(draggable, key) in draggables.items"
                        v-model="draggable.active"
                    >
                        {{-- head --}}
                        <v-toolbar card role="button" slot="header" class="sortable-handle parent-handle light-green lighten-3" dense @click.native="draggable.active = !draggable.active">
                            <v-icon>drag_handle</v-icon>
                            <v-toolbar-title class="subheading">@{{ draggable.resource.title }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon>@{{ draggable.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                            <v-btn icon @click.native="draggables.items.splice(key, 1)"><v-icon>close</v-icon></v-btn>
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
                                            <v-btn icon class="teal--text text--darken-1" v-tooltip:left="{'html': '{{ __('Add Content') }}'}" @click.native="addSection(draggable.sections)"><v-icon>add</v-icon></v-btn>

                                            <v-btn icon class="teal--text text--darken-1" v-tooltip:left="{'html': '{{ __('Toggle Bulk Commands') }}'}"><v-icon>check_box_outline_blank</v-icon></v-btn>
                                        </v-toolbar>

                                        <draggable class="sortable-container pa-1" v-model="draggable.sections" :options="{animation: 150, handle: '.sortable-handle', group: 'contents', draggable: '.draggable-child'}">
                                            <transition-group>
                                                <v-card
                                                    class="draggable-child mb-2 elevation-1"
                                                    tile
                                                    v-for="(content, c) in draggable.sections"
                                                    :key="c">
                                                    {{-- head --}}
                                                    <v-toolbar card role="button" class="sortable-handle teal lighten-2" dense @click.native="content.active = !content.active">
                                                        <v-icon>drag_handle</v-icon>
                                                        {{-- <v-checkbox hide-details color="yellow" v-model="content.model"></v-checkbox> --}}
                                                        <v-spacer></v-spacer>
                                                        <v-toolbar-title class="subheading">@{{ content.resource.title }}</v-toolbar-title>
                                                        <v-spacer></v-spacer>
                                                        <v-icon>@{{ content.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                                                        <v-btn icon @click.native="draggable.sections.splice(c, 1)"><v-icon>close</v-icon></v-btn>
                                                    </v-toolbar>

                                                    {{-- content --}}
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

                                                            <v-card-text>
                                                                <v-card @click.native.stop="media(content).open()" flat class="pa-1 grey lighten-4" v-if="content.section">
                                                                    <v-card-media :src="content.section.thumbnail" height="200px"></v-card-media>
                                                                    <v-card-title v-html="content.section.name"></v-card-title>
                                                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][library_id]`" :value="content.section.id">
                                                                </v-card>
                                                                <v-spacer></v-spacer>
                                                            </v-card-text>
                                                            <v-card-actions>
                                                                <v-btn @click.native.stop="media(content).open()"><v-icon left>perm_media</v-icon>{{ __('Media...') }}</v-btn>
                                                            </v-card-actions>
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

{{-- <v-btn @click.native.stop="media(content).open()"><v-icon left>perm_media</v-icon>{{ __('Media...') }}</v-btn> --}}
@include("Theme::mediabox.media")

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
                        },
                    },
                    draggables: {
                        items: [],
                        old: [],
                    },
                    mediabox: {
                        contents: {
                            packages: [],
                        },
                    },
                };
            },

            events: {
                'mediabox.select': function (val) {
                    console.log(val);
                }
            },

            watch: {
                'mediabox.value': function (val) {
                    if (this.mediabox.value !== null) {
                        let origin = val.origin ? val.origin : null;

                        if (origin) {
                            origin.section = val.item;
                            console.log(origin.section.thumbnail);
                        }

                        // Reset
                        this.mediabox.model = false;
                        this.mediabox.value = null;
                    }
                },
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
                            quill: {},
                        },
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
                        },
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
                }
            },

            mounted () {
                this.old();
            },
        });
    </script>
@endpush
