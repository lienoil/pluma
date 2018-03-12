@extends("Theme::layouts.admin")

@section("content")
    @include("Theme::partials.banner")
    <v-toolbar light class="white sticky elevation-1">
        <v-toolbar-title class="accent--text">{{ __('Create Course') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        @include("Theme::cards.save")
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <form ref="form" action="{{ route('courses.store') }}" method="POST">
            {{ csrf_field() }}

            <v-layout row wrap>
                <v-flex sm9 xs12>
                    <v-card class="mb-3 elevation-1">

                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.title"
                                label="{{ __('Title') }}"
                                name="title"
                                value="{{ old('title') }}"
                                @input="(val) => { resource.item.title = val; }"
                            ></v-text-field>

                            <v-text-field
                                :append-icon-cb="() => (resource.slug.readonly = !resource.slug.readonly)"
                                :append-icon="resource.slug.readonly ? 'fa-lock' : 'fa-unlock'"
                                :error-messages="resource.errors.slug"
                                :readonly="resource.slug.readonly"
                                :value="resource.item.title ? resource.item.title : '{{ old('slug') }}' | slugify"
                                label="{{ _('Slug') }}"
                                name="slug"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.code"
                                value="{{ old('code') }}"
                                hint="{{ __('Will be used as an ID for Roles. Make sure the code is unique.') }}"
                                label="{{ _('Code') }}"
                                name="code"
                            ></v-text-field>
                        </v-card-text>

                        <v-divider></v-divider>
                        {{-- Editor --}}
                        <v-quill class="elevation-0" source :options="{placeholder: '{{ __('Describe this course...') }}'}" v-model="quill.values" class="mb-3 white elevation-1" :fonts="['Default', 'Montserrat', 'Roboto']">
                            <template>
                                <input type="hidden" name="body" :value="quill.values.html">
                                <input type="hidden" name="delta" :value="JSON.stringify(quill.values.delta)">
                            </template>
                        </v-quill>
                        {{-- /Editor --}}

                        <v-divider></v-divider>

                        {{-- Lessons --}}
                        @include("Course::cards.lessons")
                        {{-- /Lessons --}}
                    </v-card>
                </v-flex>

                <v-flex sm3 xs12>
                    {{-- @include("Theme::cards.saving") --}}
                    <v-card class="elevation-1">
                        @include("Yggdrasil::cards.cover")
                        <v-divider></v-divider>

                        @include("Theme::cards.feature")
                        <v-divider></v-divider>

                        @include("Theme::cards.category")
                        <v-divider></v-divider>

                        @include("Course::cards.survey")
                    </v-card>
                </v-flex>
            </v-layout>

        </form>
    </v-container>
@endsection

@push('pre-css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    quill: {
                        values: {
                            html: '{!! json_encode(old('body')) !!}',
                            delta: '{!! json_encode(old('delta')) !!}',
                        },
                    },
                    resource: {
                        item: {
                            title: '',
                            slug: '',
                            code: '',
                            body: '',
                            cover: '{!! old('cover_obj') !!}' ? JSON.parse('{!! old('cover_obj') !!}') : null,

                            feature: '{!! old('feature_obj') !!}' ? JSON.parse('{!! old('feature_obj') !!}') : null,
                            category: JSON.parse({!! json_encode(old('category')) !!}),
                            survey_id: '{{ old('survey_id') }}'
                        },
                        feature: {
                            model: false,
                            current: {},
                            catalogues: JSON.parse(JSON.stringify({!! json_encode($catalogues) !!})),
                        },
                        cover: {
                            model: false,
                        },
                        surveys: {!! json_encode($surveys) !!},
                        slug: {
                            readonly: true,
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },

        });
    </script>
@endpush
