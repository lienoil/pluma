<template>
    <v-card class="elevation-1 grey lighten-4" :class="lessons.toolbar.modes.distraction.model?'mode-distraction-free mb-0':'mb-3'">
        <v-toolbar card class="white lighten-3 sticky" :class="lessons.toolbar.modes.distraction.model?'mode-distraction-free--toolbar elevation-3':''">
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
                    v-tooltip:left="{'html': lessons.toolbar.expand.model?'{{ __('Expand All') }}':'{{ __('Compress All') }}'}"
                    @click.native.stop="toolbar().expand().toggle(draggables.items, lessons.toolbar.expand.model)"
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
                    <p v-if="resource.errors.lessons" class="caption error--text" v-html="resource.errors.lessons.join(', ')"></p>
                    <p v-else class="subheading text-xs-center ma-0">{{ __('no lessons planned yet') }}</p>
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
                        {{-- <v-scale-transition> --}}
                            <v-card flat tile v-show="draggable.active" transition="slide-y-transition">
                                <v-layout row wrap>
                                    <v-flex sm12>
                                        <v-card-text>
                                            <input type="hidden" :name="`lessons[${key}][sort]`" :value="key">
                                            <input type="hidden" :name="`lessons[${key}][icon]`" :value="draggable.resource.icon">
                                            <v-menu
                                                offset-x
                                                offset-y
                                                v-model="draggable.icon"
                                                full-width
                                            >
                                                <v-text-field
                                                    slot="activator"
                                                    label="{{ __('Lesson Title') }}"
                                                    :prepend-icon="draggable.resource.icon"
                                                    :append-icon-cb="() => { draggable.icon = !draggable.icon }"
                                                    append-icon="fa-ellipsis-h"
                                                    :name="`lessons[${key}][title]`"
                                                    :error-messages="resource.errors[`lessons.${key}.title`]"
                                                    v-model="draggable.resource.title"
                                                ></v-text-field>
                                                <v-card>
                                                    <v-list>
                                                        <v-list-tile v-for="item in draggables.icons.items" :key="item.name" @click="draggable.resource.icon = item.name">
                                                            <v-list-tile-action>
                                                                <v-icon>@{{ item.name }}</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title>@{{ item.name }}</v-list-tile-title>
                                                        </v-list-tile>
                                                    </v-list>
                                                </v-card>
                                            </v-menu>
                                        </v-card-text>

                                        {{-- Quill --}}
                                        <v-quill :id="`lessons-${key}-editor`" v-model="draggable.resource.quill" class="mb-3 white" :fonts="['Montserrat', 'Roboto']">
                                            <template>
                                                <input type="hidden" :name="`lessons[${key}][body]`" :value="draggable.resource.quill?draggable.resource.quill.html:''">
                                                <input type="hidden" :name="`lessons[${key}][delta]`" :value="draggable.resource.quill?JSON.stringify(draggable.resource.quill.delta):''">
                                            </template>
                                        </v-quill>
                                        {{-- /Quill --}}

                                    </v-flex>
                                </v-layout>

                                {{-- Content Card --}}
                                <v-divider></v-divider>
                                <v-card flat class="white">
                                    <v-toolbar card class="white sticky">
                                        <v-icon left class="yellow--text text--darken-2">fa-file</v-icon>
                                        <v-toolbar-title class="subheading yellow--text text--darken-2">{{ __('Content') }}</v-toolbar-title>
                                        <v-spacer></v-spacer>
                                        <v-btn icon class="grey--text" v-tooltip:left="{'html': '{{ __('Add Content') }}'}" @click.native.stop="addSection(draggable.sections)"><v-icon>add</v-icon></v-btn>
                                        <v-btn icon class="grey--text" v-tooltip:left="{'html': '{{ __('Toggle Bulk Commands') }}'}"><v-icon>check_box_outline_blank</v-icon></v-btn>
                                    </v-toolbar>
                                    <v-card-text>
                                        <template v-if="!draggable.sections.length">
                                            <v-card-text
                                                class="text-xs-center grey--text grey lighten-4 py-5"
                                                role="button"
                                                @click.stop="addSection(draggable.sections)">
                                                <v-icon x-large>note_add</v-icon>
                                                <p v-if="resource.errors[`lessons.${key}.contents`]" class="caption error--text" v-html="resource.errors[`lessons.${key}.contents`].join(', ')"></p>
                                                <p class="caption text-xs-center">{{ __('no contents yet') }}</p>
                                            </v-card-text>
                                        </template>
                                        <template v-else>
                                            <draggable v-show="draggable.sections && draggable.sections.length" class="sortable-container pa-1" v-model="draggable.sections" :options="{animation: 150, handle: '.sortable-handle', group: 'contents', draggable: '.draggable-child', forceFallback: true}">
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
                                                        {{-- <v-slide-y-transition> --}}
                                                            <div v-show="content.active" transition="slide-y-transition">
                                                                <v-card-text>
                                                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][sort]`" :value="c">
                                                                    <v-text-field
                                                                        :name="`lessons[${key}][contents][${c}][title]`"
                                                                        label="{{ __('Content Title') }}"
                                                                        :error-messages="resource.errors[`lessons.${key}.contents.${c}.title`]"
                                                                        v-model="content.resource.title"
                                                                    ></v-text-field>
                                                                </v-card-text>

                                                                {{-- Quill --}}
                                                                <v-quill :id="`lessons-${key}-contents-${c}-editor`" v-model="content.resource.quill" class="mb-3 white" :fonts="['Montserrat', 'Roboto']">
                                                                    <template>
                                                                        <input type="hidden" :name="`lessons[${key}][contents][${c}][body]`" :value="content.resource.quill.html">
                                                                        <input type="hidden" :name="`lessons[${key}][contents][${c}][delta]`" :value="JSON.stringify(content.resource.quill.delta)">
                                                                    </template>
                                                                </v-quill>
                                                                {{-- /Quill --}}

                                                                {{-- Interactive Content --}}
                                                                <v-card-text class="grey lighten-4">
                                                                    <p class="subheading grey--text" @click.stop="content.mediabox = !content.mediabox">{{ __('Interactive Content') }}</p>
                                                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][interactive]`" :value="JSON.stringify(content.resource.interactive)">
                                                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][library_id]`" :value="content.resource.interactive && content.resource.interactive.length ? content.resource.interactive[0].id : null">
                                                                    <template v-if="content.resource.interactive && !content.resource.interactive.length">
                                                                        <v-card-text
                                                                            class="grey lighten-3 text-xs-center grey--text py-5"
                                                                            ripple
                                                                            role="button"
                                                                            @click.stop="content.mediabox = !content.mediabox">
                                                                            <v-icon x-large>movie</v-icon>
                                                                            <p v-if="resource.errors[`lessons.${key}.contents.${c}.library_id`]" class="caption error--text" v-html="resource.errors[`lessons.${key}.contents.${c}.library_id`].join(', ')"></p>
                                                                            <p class="text-xs-center ma-0">{{ __('add interactive content') }}</p>
                                                                        </v-card-text>
                                                                    </template>
                                                                    {{-- Preview --}}
                                                                    <v-scale-transition>
                                                                        <v-card class="mt-3" v-show="content.resource.interactive.length" :key="i" v-for="(o, i) in content.resource.interactive" @click.stop="content.mediabox = true" role="button">
                                                                            <v-card-media :src="o.thumbnail" height="250px">
                                                                                <v-container fill-height fluid class="pa-0 white--text">
                                                                                  <v-layout column>
                                                                                    <v-card-title class="subheading">
                                                                                        <div v-html="o.name"></div>
                                                                                        <v-spacer></v-spacer>
                                                                                        <v-btn dark icon @click.stop="content.resource.interactive = []"><v-icon>close</v-icon></v-btn>
                                                                                    </v-card-title>
                                                                                    <v-spacer></v-spacer>
                                                                                    <v-card-actions class="px-2 white--text">
                                                                                        <v-icon class="white--text" v-html="o.icon"></v-icon>
                                                                                        <v-spacer></v-spacer>
                                                                                        <span v-html="o.mime"></span>
                                                                                        <span v-html="o.filesize"></span>
                                                                                    </v-card-actions>
                                                                                  </v-layout>
                                                                                </v-container>
                                                                            </v-card-media>
                                                                        </v-card>
                                                                    </v-scale-transition>
                                                                    {{-- /Preview --}}
                                                                </v-card-text>
                                                                <v-card-actions class="grey lighten-4">
                                                                    <v-spacer></v-spacer>
                                                                    <v-mediabox search :multiple="false" close-on-click :categories="mediabox.catalogues" v-model="content.mediabox" :old="content.resource.interactive ? content.resource.interactive : []" @selected="value => { content.resource.interactive = value }">
                                                                        <template slot="media" scope="props">
                                                                            <v-card transition="scale-transition" class="accent" :class="props.item.active?'elevation-10':'elevation-1'">
                                                                                {{-- <span v-html="props"></span> --}}
                                                                                <v-card-media height="250px" :src="props.item.thumbnail">
                                                                                    <v-container fill-height class="pa-0 white--text">
                                                                                        <v-layout fill-height wrap column>
                                                                                            <v-card-title class="subheading" v-html="props.item.originalname"></v-card-title>
                                                                                            <v-slide-y-transition>
                                                                                                <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="props.item.active">check</v-icon>
                                                                                            </v-slide-y-transition>
                                                                                            <v-spacer></v-spacer>
                                                                                            <v-card-actions class="px-2 white--text">
                                                                                                <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                                                                                                <v-spacer></v-spacer>
                                                                                                <span v-html="props.item.mime"></span>
                                                                                                <span v-html="props.item.filesize"></span>
                                                                                            </v-card-actions>
                                                                                        </v-layout>
                                                                                    </v-container>
                                                                                </v-card-media>
                                                                            </v-card>
                                                                        </template>
                                                                    </v-mediabox>
                                                                </v-card-actions>
                                                                {{-- Interactive Content --}}
                                                            </div>
                                                        {{-- </v-slide-y-transition> --}}

                                                    </v-card>
                                                </transition-group>
                                            </draggable>
                                        </template>
                                    </v-card-text>
                                </v-card>
                                {{-- /Content Card --}}

                                {{-- Assignment Card --}}
                                <v-divider></v-divider>
                                @include("Course::cards.assignment")
                                {{-- /Assignment Card --}}
                            </v-card>
                        {{-- </v-scale-transition> --}}
                    </v-card>
                </transition-group>
            </draggable>
        </v-card-text>
    </v-card>
</template>

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
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
                            expand: {
                                model: false,
                            }
                        },
                    },
                    draggables: {
                        icons: {
                            model: false,
                            items: [
                                {name: 'fa-edit'},
                                {name: 'perm_media'},
                                {name: 'face'},
                                {name: 'tag_faces'},
                            ],
                        },
                        items: [],
                        old: [],
                    },
                    mediabox: {
                        model: false,
                        output: null,
                        catalogues: JSON.parse(JSON.stringify({!! json_encode($catalogues) !!})),
                    }
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
                                toggle (togglables, value) {
                                    self.lessons.toolbar.expand.model = !value;
                                    for (var i = 0; i < togglables.length; i++) {
                                        let current = togglables[i];
                                        current.active = value;
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
                        icon: false,
                        resource: {
                            title: 'Untitled #' + (sections.length + 1),
                            icon: '',
                            code: '',
                            quill: {},
                            interactive: null,
                            assignment: {
                                title: '', code: '', quill: {}, attachment: null,
                            },
                        },
                        mediabox: false,
                        assignment: {
                            add: false,
                            model: false,
                        },
                        sections: [],
                    }
                    sections.push(c);
                },

                updateSection (sections, values) {
                    sections.push({
                        id: values.id,
                        name: values.name,
                        active: true,
                        icon: false,
                        resource: {
                            title: values.title,
                            code: values.code,
                            icon: values.icon,
                            quill: {
                                html: values.body,
                                delta: JSON.parse(values.delta),
                            },
                            interactive: values.interactive ? JSON.parse(values.interactive) : [],
                            assignment: values.assignment,
                        },
                        mediabox: false,
                        assignment: {
                            model: false,
                        },
                        sections: [],
                    });
                },

                close (origin, options) {
                    console.log("mediabox-origin", origin);
                },

                old () {
                    let olds = {!! json_encode(old('lessons')) !!};
                    console.log("OLD", olds);
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

                getMediaboxOutput (content, value) {
                    // console.log('GMO', content, value)
                }
            },

            mounted () {
                this.old();
            },
        });
    </script>
@endpush
