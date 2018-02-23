@extends("Theme::layouts.admin")

@section("head-title", __('Forum | Ask a Question'))


@section("content")
    <v-toolbar dark class="secondary elevation-1 sticky">
        <v-icon dark left>fa-question</v-icon>
        <v-toolbar-title dark primary-title>{{ __('Edit Question') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <form action="{{ route('forums.update', $resource->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <v-layout row wrap>
                <v-flex xs12 sm9>

                    <v-card>
                        <v-card-text>

                            <v-text-field
                                :error-messages="resource.errors.name"
                                {{-- label="{{ _('Question') }}" --}}
                                prepend-icon="fa-question"
                                name="name"
                                solo
                                placeholder="{{ __('Write a short question or phrase that best describes your topic or question') }}"
                                persistent-hint
                                v-model="resource.item.name"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>

                            {{-- Categories --}}
                            {{-- @include("Forum::cards.forum-attributes") --}}
                            {{-- /Categories --}}
                        </v-card-text>

                        <v-divider></v-divider>
                        {{-- Editor --}}
                        <v-quill
                            paper
                            :options="{
                                placeholder: '{{ __('Describe the topic or question in more detail...') }}',
                            }"
                            :toolbar-options="[
                                [{'header':1},{'header':2}],
                                ['bold','italic','underline','strike'],
                                [{'align':''},{'align':'center'},{'align':'right'},{'align':'justify'}],
                                ['blockquote','code-block'],
                                [{'list':'ordered'},{'list':'bullet'}],
                                [{'indent':'-1'},{'indent':'+1'},'image'],
                            ]"
                            class="elevation-0"
                            class="mb-3 card--flat white elevation-1"
                            v-model="resource.quill"
                        >
                            <template>
                                <input type="hidden" name="body" :value="resource.quill.html">
                                <input type="hidden" name="delta" :value="JSON.stringify(resource.quill.delta)">
                            </template>
                        </v-quill>
                        {{-- /Editor --}}

                    </v-card>

                </v-flex>

                <v-flex xs12 sm3>
                    @include("Forum::cards.publishing")
                </v-flex>
            </v-layout>
        </form>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    <style>
        .quill-container.ql-paper .ql-toolbar.ql-snow {
            text-align: center;
            margin-top: 1rem;
        }
        .quill-container.ql-paper .ql-toolbar.ql-snow .ql-image {
            display: none;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
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
                        quill: {
                            html: {!! json_encode(old('body') ?? $resource->body) !!},
                            delta: JSON.parse({!! json_encode(old('delta') ?? $resource->delta) !!}),
                        },
                        item: {
                            name: {!! json_encode(old('name') ?? $resource->name) !!},
                            code: '',
                            body: '',
                            category_id: '{{ old('category_id') ?? $resource->category_id }}',
                        },
                        categories: {!! json_encode($categories->toArray()) !!},
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
        });
    </script>
@endpush
