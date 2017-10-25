@extends("Theme::layouts.admin")

@section("head-title", __($resource->name))
@section("page-title", __($resource->name))

@section("content")
    @include("Frontier::partials.banner")
    <v-toolbar dark extended class="light-blue elevation-0">
        <v-btn
            href="{{ route('forums.index') }}"
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12 md8 offset-md2>
                <v-card class="grey--text elevation-1 card--flex-toolbar">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __($resource->name) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon ripple v-tooltip:left="{ html: 'Favorite' }">
                            <v-icon class="grey--text text--lighten-1">star_border</v-icon>
                        </v-btn>
                        <v-menu bottom left>
                            <v-btn icon flat slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                            <v-list>
                                <v-list-tile ripple :href="route(urls.forums.edit, ('{{ $resource->id }}'))">
                                    <v-list-tile-action>
                                        <v-icon accent>edit</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            {{ __('Edit') }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-list-tile ripple
                                    @click="destroy(route(urls.forums.api.destroy, '{{ $resource->id }}'),
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
                            </v-list>
                        </v-menu>
                    </v-toolbar>

                    <v-card-text class="black--text pt-0">
                        <div><a href="#!" class="teal--text text-decor-none"><strong>{{ auth()->user()->fullname }}</strong></a></div>
                        <div class="mb-2"><span class="grey--text">July 15, 2017</span></div>
                        <div>{{ $resource->description }}</div>
                    </v-card-text>
                    <v-card-text class="text-xs-right">
                        <div class="grey--text caption">Tagged:
                            <v-chip label class="grey lighten-3 elevation-0">
                                <v-icon left class="orange--text">label</v-icon>Workskill SUP
                            </v-chip>
                        </div>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-subheader class="grey--text">Write a Comment</v-subheader>

                    <div>
                        <v-card class="elevation-0">
                            <v-quill v-model="quill.comment"></v-quill>
                            <v-divider></v-divider>
                            <v-card-text class="text-xs-right pa-0">
                                <v-btn flat primary class="primary--text">Submit</v-btn>
                            </v-card-text>
                        </v-card>
                    </div>
                    <v-list two-line class="pb-3">
                        <v-list-tile avatar>
                            <v-list-tile-avatar>
                                <img src="{{ auth()->user()->avatar }}" />
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title><a href="#!" class="teal--text text-decor-none"><strong>{{ auth()->user()->fullname }}</strong></a></v-list-tile-title>
                                <v-list-tile-sub-title>August 12, 2017</v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_horiz</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile ripple @click="">
                                            <v-list-tile-action>
                                                <v-icon accent>report</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Report') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple @click="">
                                            <v-list-tile-action>
                                                <v-icon error>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Delete') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-menu>
                            </v-list-tile-action>
                        </v-list-tile>
                        <div class="pl-7 pr-4 black--text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, necessitatibus, nulla! Autem sint, iure nobis nemo tempore delectus illo doloribus mollitia perferendis, minus unde! Sit culpa optio, a adipisci assumenda.
                        </div>
                    </v-list>
                </v-card>
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
    </style>
@endpush


@push('pre-scripts')
     <script src="http://localhost:8080/dist/vuetify-dropzone.min.js"></script>
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('test/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
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
                        forums: {
                            api: {
                                clone: '{{ route('api.forums.clone', 'null') }}',
                                destroy: '{{ route('api.forums.destroy', 'null') }}',
                            },
                            show: '{{ route('forums.show', 'null') }}',
                            edit: '{{ route('forums.edit', 'null') }}',
                            destroy: '{{ route('forums.destroy', 'null') }}',
                        },
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
