@extends("Theme::layouts.admin")

@section("head-title", __($resource->name))

@section("content")
    @include("Frontier::partials.banner")

    <v-toolbar dark extended class="light-blue elevation-0">
        <v-btn ripple flat href="{{ route('forums.index') }}">
            <v-icon left dark>arrow_back</v-icon>
            {{ __('Back') }}
        </v-btn>
    </v-toolbar>
    <v-container fluid grid-list-lg>

        <v-layout row wrap>
            <v-flex xs12 md8 offset-md2>
                <v-card class="grey--text elevation-1 card--flex-toolbar mb-3">
                    {{-- title and actions --}}
                    <v-card-actions class="px-custom-20 py-2">
                       <div class="title fw-400 grey--text text--darken-3 no--decoration pa-0 mb-0">
                            {{ $resource->name }}
                        </div>
                        <v-spacer></v-spacer>
                        <v-menu bottom left>
                            <v-btn icon flat slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                            <v-list>
                                @can("edit-forum")
                                    <v-list-tile ripple :href="route(urls.edit, ('{{ $resource->id }}'))">
                                        <v-list-tile-action>
                                            <v-icon accent>edit</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>
                                                {{ __('Edit') }}
                                            </v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                @endcan

                                @can("destroy-forum")
                                    <v-list-tile ripple
                                        @click="destroy(route(urls.api.destroy, '{{ $resource->id }}'),
                                        {
                                            '_token': '{{ csrf_token() }}'
                                        })">
                                        <v-list-tile-action>
                                            <v-icon warning>delete</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>
                                                {{ __('Move to Trash') }}
                                            </v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                @endcan
                            </v-list>
                        </v-menu>
                    </v-card-actions>
                    {{-- title and actions --}}

                    {{-- category --}}
                    @if ($resource->category)
                        <v-card-text class="px-4 pt-0">
                            <a class="grey--text td-n" class="fw-500"
                                :href="`{{ route('forums.index') }}?category_id=${resource.category_id}`">
                                <v-icon class="orange--text mr-2">{{ $resource->category->icon }}</v-icon>
                                <span>{{ $resource->category->name }}</span>
                            </a>
                        </v-card-text>
                    @endif
                    {{-- /category --}}

                    {{-- body --}}
                    <v-card-text class="subheading grey--text text--darken-4 px-4">
                        <div>{!! $resource->body !!}</div>
                    </v-card-text>
                    {{-- /body --}}

                    {{-- author and created --}}
                    <v-card-actions class="px-custom-20 py-4">
                        <v-avatar size="30px" class="mr-2"><img src="{{ $resource->user->avatar }}"></v-avatar>
                        <a class="grey--text td-n" :href="`{{ route('forums.index') }}?user_id=${resource.user_id}`">{{ $resource->author }}</a>
                        <v-spacer></v-spacer>
                        <v-icon class="grey--text">schedule</v-icon>
                        <span class="subheading grey--text">{{ $resource->created }}</span>
                    </v-card-actions>
                    {{-- /author and created --}}
                </v-card>

                {{-- comment --}}
                <v-card class="elevation-1">
                    @include("Forum::interactives.comments")
                </v-card>
                {{-- // comment --}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    <link rel="stylesheet" href="http://localhost:8080/dist/vuetify-dropzone.min.css">
    <style>
        .text-decor-none {
            text-decoration: none;
        }
        .pl-7 {
            padding-left: 70px;
        }
        textarea {
            padding-top: 15px !important;
        }
        .comment-field .input-group__input {
            padding-top: 0 !important;
            border: 1px solid #9e9e9e !important;
        }
        .input-group__details {
            display: none;
        }
        .ql-container {
            min-height: 120px !important;
        }
        .quill-editor .ql-editor {
            min-height: auto !important;
        }
        .card--flex-toolbar {
            margin-top: -80px;
        }
        .main-paginate .pagination__item,
        .main-paginate .pagination__navigation {
            box-shadow: none !important;
        }
        .application--light .pagination__item--active {
            background: #03a9f4 !important;
        }
        .px-custom-20 {
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
        .td-n:hover,
        .td-n:target,
        .td-n:focus {
            text-decoration: none !important;
        }
    </style>
@endpush


@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-dropzone.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('test/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    showeditor: true,
                    quill: {
                        comment: {}
                    },
                    resource: {
                        item: {!! json_encode($resource) !!},
                        model: false,
                        dialog: {
                            model: false,
                        },
                    },
                    urls: {
                        api: {
                            destroy: '{{ route('api.forums.destroy', 'null') }}',
                        },
                        show: '{{ route('forums.show', 'null') }}',
                        edit: '{{ route('forums.edit', 'null') }}',
                        destroy: '{{ route('forums.destroy', 'null') }}',
                    },
                    items: [
                        {
                            header: 'Replies'
                        },
                        {
                            avatar: 'https://randomuser.me/api/portraits/women/49.jpg',
                            title: 'Have you tried testing it on Mozilla Firefox?',
                            subtitle: 'Jane Doe <span class="grey--text text--lighten-1">&mdash; August 01, 2017</span>'
                        },
                        {
                            divider: true,
                            inset: true
                        },
                        {
                            avatar: 'https://randomuser.me/api/portraits/men/49.jpg',
                            title: 'Not yet.',
                            subtitle: 'Paul Smith <span class="grey--text text--lighten-1">&mdash; August 015 2017</span>'
                        },
                    ],
                    categories: [
                        {
                            header: 'Choose Filter'
                        },
                        {
                            action: 'language',
                            title: 'All threads'
                        },
                        {
                            action: 'star',
                            title: 'My favorites'
                        },
                        {
                            action: 'whatshot',
                            title: 'Popular this week'
                        },
                        {
                            action: 'lightbulb_outline',
                            title: 'No replies yet'
                        },
                        {
                            divider: true
                        },
                        {
                            header: 'Course Categories'
                        },
                        {
                            action: 'label',
                            title: 'All Categories'
                        },
                        {
                            action: 'label',
                            title: 'Worskill OPS'
                        },
                        {
                            action: 'label',
                            title: 'Workskill SUP'
                        },
                        {
                            action: 'label',
                            title: 'ICDL',
                        }
                    ]
                };
            },

            mounted () {
                let self = this;
            }
        })
    </script>
@endpush
