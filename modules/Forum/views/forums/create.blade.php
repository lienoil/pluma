@extends("Theme::layouts.admin")

@section("head-title", __('Forum'))
@section("page-title", __('Forum'))


@section("content")
    @include("Theme::partials.banner")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card>
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('New Forum') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <form action="{{ route('forums.store') }}" method="POST">
                            {{ csrf_field() }}

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Title') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                     <v-text-field
                                        :error-message="resource.errors.name"
                                        label="{{ _('Title') }}"
                                        name="name"
                                        value="{{ old('name') }}"
                                        @input="(val) => { resource.item.name = val; }"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Code') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-text-field
                                        :error-messages="resource.errors.code"
                                        :value="resource.item.name ? resource.item.name : '{{ old('code') }}' | slugify"
                                        hint="{{ __('Will be used as a slug for Forum. Make sure the code is unique.') }}"
                                        label="{{ _('Code') }}"
                                        name="code"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Description') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-text-field
                                        :error-messages="resource.errors.body"
                                        label="{{ _('Short Description') }}"
                                        name="body"
                                        value="{{ old('body') }}"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            {{-- Categories --}}
                            @include("Forum::cards.forum-attributes")
                            {{-- /Categories --}}

                            <div class="text-sm-right">
                                <button type="submit" class="btn btn--raised primary ma-0"><span class="btn__content">{{ __('Submit') }}</span></button>
                            </div>
                        </form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .inline {
            display: inline-block;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    dataset: {
                        items: [],
                        loading: true,
                        selected: [],
                        totalItems: 0,
                    },
                    attributes: {
                        categories: JSON.parse('{!! json_encode($categories) !!}'),
                    },
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            body: '',
                            category_id: '{{ old('category_id') }}',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        category_id: '{{ old('category_id') }}',
                    },
                    urls: {
                        forums: {
                            show: '{{ route('forums.show', 'null') }}',
                            edit: '{{ route('forums.edit', 'null') }}',
                            destroy: '{{ route('forums.destroy', 'null') }}',
                        },
                    },
                };
            },

            mounted () {
                this.get();
                this.mountSuppliments();
                // console.log("dataset.pagination", this.dataset.pagination);
            },
        });
    </script>
@endpush
