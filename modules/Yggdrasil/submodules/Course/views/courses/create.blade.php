@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <form action="{{ route('courses.store') }}" method="POST">
            {{ csrf_field() }}

            <v-layout row wrap>
                <v-flex sm9>
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title>{{ __($application->page->title) }}</v-toolbar-title>
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
                    {{-- @include("Frontier::cards.editor") --}}
                    @include("Course::cards.editor")
                    {{-- /Editor --}}

                    {{-- Lessons --}}
                    @include("Course::cards.lessons")
                    {{-- /Lessons --}}
                </v-flex>

                <v-flex sm3>
                    @include("Theme::cards.saving")
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
                    resource: {
                        item: {
                            title: '',
                            slug: '',
                            code: '',
                            body: '',
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
