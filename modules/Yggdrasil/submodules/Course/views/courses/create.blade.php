@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <form action="{{ route('courses.store') }}" method="POST">
            {{ csrf_field() }}

            <v-layout row wrap>
                <v-flex sm9>
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                        </v-toolbar>

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
                                :append-icon="resource.slug.readonly ? 'fa-link' : 'fa-unlink'"
                                :error-messages="resource.errors.slug"
                                :readonly="resource.slug.readonly"
                                :value="resource.item.title ? resource.item.title : '{{ old('slug') }}' | slugify"
                                label="{{ _('Slug') }}"
                                name="slug"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.code"
                                :value="resource.item.title ? resource.item.title : '{{ old('code') }}' | slugify"
                                hint="{{ __('Will be used as an ID for Roles. Make sure the code is unique.') }}"
                                label="{{ _('Code') }}"
                                name="code"
                            ></v-text-field>
                        </v-card-text>

                    </v-card>

                    {{-- Editor --}}
                    <quill v-model="quill.values" class="mb-3 white elevation-1" :fonts="['Montserrat', 'Roboto']">
                        <template>
                            <input type="hidden" name="body" :value="quill.values.html">
                            <input type="hidden" name="delta" :value="JSON.stringify(quill.values.delta)">
                        </template>
                    </quill>
                    {{-- /Editor --}}

                    {{-- Lessons --}}
                    @include("Course::cards.lessons")
                    {{-- /Lessons --}}
                </v-flex>

                <v-flex sm3>
                    @include("Theme::cards.saving")

                    @include("Theme::cards.category")

                    @include("Theme::cards.feature")
                </v-flex>
            </v-layout>

        </form>
    </v-container>
@endsection

@push('pre-css')
    <link rel="stylesheet" href="{{ assets('frontier/dist/quill/Quill.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/dist/quill/Quill.js') }}"></script>
    <script>
        Vue.use(VueResource);
        Vue.use(Quill);

        mixins.push({
            components: { Quill },
            data () {
                return {
                    quill: {
                        values: {
                            html: '{!! old('body') !!}',
                            delta: JSON.parse({!! json_encode(old('delta')) !!}),
                        },
                    },
                    resource: {
                        item: {
                            title: '',
                            slug: '',
                            code: '',
                            body: '',
                            feature: [JSON.parse('{!! old('feature_obj') ? old('feature_obj') : '[]' !!}')],
                            category: JSON.parse({!! json_encode(old('category')) !!}),
                        },
                        feature: {
                            model: false,
                            catalogues: JSON.parse(JSON.stringify({!! json_encode($catalogues) !!})),
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
