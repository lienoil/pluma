<v-card class="elevation-0">
    <v-toolbar card class="transparent">
        <v-toolbar-title>{{ __("Comments") }}</v-toolbar-title>
    </v-toolbar>

    <v-divider></v-divider>

    @can('show-forum')
        @foreach ($resource->comments()->paginate(settings('forum_comments_per_page', 5))->items() as $comment)
            <v-card flat>
                <v-toolbar card class="transparent">
                    <v-avatar size="30px">
                        <img src="{{ $comment->user->avatar }}">
                    </v-avatar>
                    <v-toolbar-title class="subheading body-1">
                        {{ $comment->user->displayname }}
                        <div class="subheading body-1 grey--text"><v-icon left class="body-1 grey--text">access_time</v-icon> {{ $comment->created }}</div>
                    </v-toolbar-title>
                </v-toolbar>
                <v-card-text class="pl-5 body-1">
                    {!! $comment->body !!}
                </v-card-text>
                <v-divider></v-divider>
            </v-card>
        @endforeach
        <v-card-text class="pa-0">
            <v-list two-line class="py-0">
                    {{-- <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <img src="{{ $comment->user->avatar }}">
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                <a href="#!" class="td-n grey--text text--darken-4 body-2">{{ $comment->user->displayname }}</a>
                            </v-list-tile-title>
                            <v-list-tile-sub-title class="body-1">{{ $comment->created }}</v-list-tile-sub-title>
                        </v-list-tile-content> --}}

                        {{-- <v-list-tile-action>
                            <v-menu bottom left>
                                <v-btn icon flat slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
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
                                    <v-list-tile ripple
                                        @click="destroy(route(urls.comments.api.destroy, item.id),
                                        {
                                            '_token': '{{ csrf_token() }}'
                                        })">
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
                        </v-list-tile-action> --}}
                    {{-- </v-list-tile> --}}
                {{--<v-list-tile avatar>
                    <v-list-tile-avatar>
                        <img :src="item.user.avatar">
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            <a href="#!" class="td-n grey--text text--darken-4 body-2" v-html="item.user.displayname"></a>
                        </v-list-tile-title>
                        <v-list-tile-sub-title class="body-1">@{{ item.created }}</v-list-tile-sub-title>
                    </v-list-tile-content>

                    <v-list-tile-action>
                        <v-menu bottom left>
                            <v-btn icon flat slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
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
                                <v-list-tile ripple
                                    @click="destroy(route(urls.comments.api.destroy, item.id),
                                    {
                                        '_token': '{{ csrf_token() }}'
                                    })">
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
                </v-list-tile> --}}
                {{-- <div class="pl-7 pr-4 grey--text text--darken-2" v-html="item.body"></div> --}}
                <v-divider></v-divider>
            </v-list>
            <v-card-text>
                @include("Theme::partials.pagination", ['resources' => $resource->comments()->paginate(3)])
            </v-card-text>
        </v-card-text>

        <v-divider></v-divider>
        <v-card flat>
            <v-toolbar card class="transparent">
                <v-toolbar-title>{{ __("Post your comment") }}</v-toolbar-title>
            </v-toolbar>
            <v-divider></v-divider>
            <form action="{{ route('forums.comment', $resource->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ user()->id }}">

                {{-- editor --}}
                @include("Forum::widgets.editor")
                {{-- editor --}}

                <v-divider></v-divider>
                <v-card-text class="text-xs-right pa-0">

                    <v-btn type="submit" flat primary>{{ __('Post Comment') }}</v-btn>
                </v-card-text>
            </form>
            <v-divider></v-divider>
        </v-card>
    @else
        <v-card-text class="grey--text text-xs-center">
            {{ __('You do not have the permissions to comment.') }}
        </v-card-text>
    @endcan
</v-card>

@push('css')
    {{-- <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    <style>
        .pl-7 {
            padding-left: 70px;
        }
        .comment-field .input-group__input {
            padding-top: 0 !important;
            border: 1px solid #9e9e9e !important;
        }
        .ql-container {
            min-height: 120px !important;
        }
        .quill-editor .ql-editor {
            min-height: auto !important;
        }
        .main-paginate .pagination__item,
        .main-paginate .pagination__navigation {
            box-shadow: none !important;
        }
        .application--light .pagination__item--active {
            background: #03a9f4 !important;
        }
    </style>
@endpush

@push('pre-scripts')
    {{-- <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script> --}}
    {{-- <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script> --}}
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        // Vue.use(VueResource);
        mixins.push({
            data () {
                return {
                    resource: {
                        quill: {
                            html: '{!! old('body') !!}',
                            delta: JSON.parse({!! json_encode(old('delta')) !!}),
                        },
                    },
                    mediabox: {
                        model: false,
                        fonts: {!! json_encode(config('editor.fonts.enabled', [])) !!},
                        url: '',
                        resource: {
                            thumbnail: '',
                        },
                    },
                    //
                    hidden: true,
                    dataset: {
                        items: {!! json_encode($resource->comments()->paginate(5)->items()) !!},
                        loading: true,
                        urls: {
                            comments: {
                                api: {
                                    destroy: '{{ route('api.comments.destroy', 'null') }}',
                                },
                                show: '{{ route('comments.show', 'null') }}',
                                edit: '{{ route('comments.edit', 'null') }}',
                                destroy: '{{ route('comments.destroy', 'null') }}',
                            },
                        },
                    },
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            grants: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                }
            },
            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy,
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.comments.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            // this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },

                post (url, query) {
                    var self = this;
                    this.api().post(url, query)
                        .then((data) => {
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.comments.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },
            },

            mounted () {
                // this.get();
                // console.log("dataset.pagination", this.dataset.pagination);
            },
        })
    </script>
@endpush
