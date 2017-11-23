@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <form action="{{ route('pages.store') }}" method="POST">
            {{ csrf_field() }}
            <v-layout row wrap>
                <v-flex md9>
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title>{{ __('New Page') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field
                                name="title"
                                label="{{ __('Title') }}"
                                v-model="resource.title"
                                @input="() => { resource.slug = resource.title}"
                            ></v-text-field>

                            <v-text-field
                                :append-icon-cb="() => (resource.readonly.slug = !resource.readonly.slug)"
                                :append-icon="resource.readonly.slug ? 'fa-link' : 'fa-unlink'"
                                :readonly="resource.readonly.slug"
                                :value="resource.slug?resource.slug:'' | slugify"
                                label="{{ __('Slug') }}"
                                name="slug"
                            ></v-text-field>

                        </v-card-text>


                        <v-divider></v-divider>
                        {{-- Editor --}}
                        <v-quill class="elevation-0" source :options="{placeholder: '{{ __('Write something...') }}'}" v-model="resource.quill" class="mb-3 card--flat white elevation-1" :fonts="['Default', 'Montserrat', 'Roboto']">
                            <template>
                                <input type="hidden" name="body" :value="resource.quill.html">
                                <input type="hidden" name="delta" :value="JSON.stringify(resource.quill.delta)">
                            </template>
                        </v-quill>
                        {{-- /Editor --}}
                    </v-card>
                </v-flex>

                <v-flex md3>
                    @include("Theme::cards.saving")
                </v-flex>

                <v-flex sm6>
                    <v-card class="elevation-1 mb-3">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title class="accent--text">{{ __('Page Attributes') }}</v-toolbar-title>
                        </v-toolbar>

                        {{-- <v-card-text>
                            <v-select
                                v-model="resource.parent"
                                :items="supplimentary.pages.items"
                                label="{{ __('Parent Page') }}"
                                class="input-group--focused"
                                item-text="title"
                                item-value="id"
                            ></v-select>
                            <input name="parent_id" type="hidden" :value="resource.parent">
                        </v-card-text> --}}

                        <v-card-text class="grey lighten-4">
                            @include("Page::interactive.pages", ['items' => $pages])
                        </v-card-text>

                    </v-card>
                </v-flex>

            </v-layout>
        </form>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        title: '',
                        slug: '',
                        parent: null,
                        parent_id: '',
                        quill: {
                            body: '',
                            delta: '',
                        },
                        readonly: {
                            slug: true,
                        },
                        toggle: {
                            parent_id: false,
                        },
                        misc: {
                            parent: {
                                title: 'None',
                            }
                        }
                    },

                }
            },
        })
    </script>
@endpush
