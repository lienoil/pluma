<template>
    <v-card class="mb-3 elevation-1 grey lighten-4">
        <v-toolbar card dense class="green lighten-4">
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
                        <v-toolbar card role="button" slot="header" class="light-green lighten-4" dense @click.native="draggable.active = !draggable.active">
                            <div class="sortable-handle parent-handle"><v-icon>drag_handle</v-icon></div>
                            <v-toolbar-title class="subheading">@{{ draggable.resource.title }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon>@{{ draggable.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                            <v-btn icon @click.native="draggables.items.splice(key, 1)"><v-icon>close</v-icon></v-btn>
                        </v-toolbar>

                        {{-- content --}}
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
                                    <v-flex sm9>
                                        <v-subheader>{{ __('Content') }}</v-subheader>
                                        <v-card-text>
                                            <v-card
                                                flat
                                                class="mb-2 cyan darken-1 white--text"
                                                v-for="(content, c) in draggable.sections"
                                                :key="c"
                                            >
                                                {{-- head --}}
                                                <v-toolbar card dark role="button" s----lot="header" class="transparent" dense @click.native="content.active = !content.active">
                                                    <div class="sortable-handle"><v-icon dark>drag_handle</v-icon></div>
                                                    <v-toolbar-title class="subheading">@{{ c + 1 }} | @{{ content.resource.title }}</v-toolbar-title>
                                                    <v-spacer></v-spacer>
                                                    <v-icon dark>@{{ content.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                                                </v-toolbar>

                                                {{-- content --}}
                                                <v-slide-y-transition>
                                                    <v-card-text v-show="content.active">
                                                        @include("Theme::dialogs.media")
                                                    </v-card-text>
                                                </v-slide-y-transition>

                                            </v-card>
                                        </v-card-text>
                                    </v-flex>
                                </v-layout>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn flat info @click.native="addSection(draggable.sections)">{{ __('Add Content') }}</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-slide-y-transition>
                    </v-card>
                </transition-group>
            </draggable>
        </v-card-text>
    </v-card>
</template>

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
                //
            },
        });
    </script>
@endpush
