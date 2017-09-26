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

                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card dense class="transparent">
                            <v-icon class="accent--text">perm_media</v-icon>
                            <v-toolbar-title class="subheading accent--text">{{ __('Featured Image') }}</v-toolbar-title>
                        </v-toolbar>
                        <v-mediabox search="mime:image" :multiple="false" close-on-click :categories="resource.feature.catalogues" v-model="resource.feature.model" :old="resource.item.feature ? resource.item.feature : []" @selected="value => { resource.item.feature = value[0] }">
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

                        <v-card-media
                            :src="resource.item.feature ? resource.item.feature.thumbnail : ''"
                            height="200px"
                            role="button"
                            @click.stop="resource.feature.model = !resource.feature.model">
                            <v-container fill-height fluid class="pa-0 white--text">
                                <v-layout column>
                                    <v-card-title class="pa-0 subheading">
                                        <v-spacer></v-spacer>
                                        <v-btn dark icon @click.stop="resource.item.feature = null"><v-icon>close</v-icon></v-btn>

                                        <input type="hidden" name="feature" :value="resource.item.feature ? resource.item.feature.thumbnail : ''">
                                    </v-card-title>
                                </v-layout>
                            </v-container>
                        </v-card-media>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn flat @click.stop="resource.feature.model = !resource.feature.model" v-html="resource.item.feature ? '{{ __('Change') }}' : '{{ __('Browse') }}'"></v-btn>
                        </v-card-actions>
                    </v-card>

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
                            feature: '',
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
