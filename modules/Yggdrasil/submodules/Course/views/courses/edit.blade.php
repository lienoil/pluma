@extends("Theme::layouts.admin")

@section("head-title", $resource->title)

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")

        <form action="{{ route('courses.update', $resource->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <v-layout row wrap>
                <v-flex sm9>
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title class="accent--text">{{ $resource->title }}</v-toolbar-title>
                        </v-toolbar>

                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.title"
                                label="{{ __('Title') }}"
                                name="title"
                                value="{{ $resource->title }}"
                                @input="(val) => { resource.item.title = val; }"
                            ></v-text-field>

                            <v-text-field
                                :append-icon-cb="() => (resource.slug.readonly = !resource.slug.readonly)"
                                :append-icon="resource.slug.readonly ? 'fa-link' : 'fa-unlink'"
                                :error-messages="resource.errors.slug"
                                :readonly="resource.slug.readonly"
                                :value="resource.item.title ? resource.item.title : '{{ $resource->slug }}' | slugify"
                                label="{{ _('Slug') }}"
                                name="slug"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.code"
                                value="{{ $resource->code }}"
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
                        @include("Course::cards.edit-lessons")
                        {{-- /Lessons --}}
                    </v-card>
                </v-flex>

                <v-flex sm3>
                    @include("Theme::cards.saving")

                    @include("Theme::cards.category")

                    @include("Yggdrasil::cards.cover")

                    @include("Theme::cards.feature")
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
                            html: '{!! $resource->body !!}',
                            delta: JSON.parse({!! json_encode($resource->delta) !!}),
                        },
                    },
                    resource: {
                        item: {
                            title: '',
                            slug: '',
                            code: '',
                            body: '',
                            cover: '{!! $resource->cover_obj !!}' ? JSON.parse('{!! $resource->cover_obj !!}') : null,
                            feature: '{!! $resource->feature_obj !!}' ? JSON.parse('{!! $resource->feature_obj !!}') : null,
                            category: JSON.parse({!! json_encode($resource->category) !!}),
                        },
                        feature: {
                            model: false,
                            catalogues: JSON.parse(JSON.stringify({!! json_encode($catalogues) !!})),
                        },
                        cover: {
                            model: false,
                        },
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
