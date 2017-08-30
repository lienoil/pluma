<template>

    <v-card class="mb-3 elevation-1">
        <v-toolbar card class="transparent">
            <v-toolbar-title>{{ __('Lessons') }}</v-toolbar-title>
        </v-toolbar>

        <div class="grey lighten-5">
        <v-expansion-panel flat class="elevation-0">
            <draggable v-model="draggables.items" class="sortable-container">
                <transition-group>
                    <v-expansion-panel-content v-for="(draggable, key) in draggables.items" :key="key">
                        <div card slot="header">
                            [@{{ draggable.id }}] {{ __('Lesson') }} @{{ key + 1 }} <strong v-show="draggable.resource.title">| @{{ draggable.resource.title }}</strong>
                        </div>
                        <v-card class="white" flat>

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

                            {{-- <v-card-text>
                                <draggable v-model="draggable.sections" class="sortable-child-container">
                                    <template v-for="(child, i) in draggable.sections" :key="i">
                                        <v-card flat class="mb-1">
                                            <v-subheader>{{ __('Content') }} @{{ i + 1 }}</v-subheader>
                                            <v-card-text>
                                                asd
                                            </v-card-text>
                                        </v-card>
                                    </template>
                                </draggable>
                            </v-card-text> --}}

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn flat @click.native="addContent(key)">{{ __('Add Content') }}</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-expansion-panel-content>
                </transition-group>

            </draggable>
                <template slots="footer">
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn flat success @click.native="addSection">{{ __('Add Lesson') }}</v-btn>
                    </v-card-actions>
                </template>
        </v-expansion-panel>
        </div>

        {{--  --}}
    </v-card>
</template>

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    draggables: {
                        items: [],
                    },
                };
            },

            methods: {
                addSection () {
                    this.draggables.items.push({
                        id: this.draggables.items.length + 1,
                        name: '{{ __('Lesson') }}',
                        resource: {
                            title: '',
                            code: '',
                        },
                        sections: [],
                    });
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
