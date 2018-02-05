<v-card class="elevation-0">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="subheading page-title">{{ __("Comments") }}</v-toolbar-title>
    </v-toolbar>
    <v-divider></v-divider>

    @can('show-forum')
        @if ($resource->comments()->get()->isEmpty())
            <v-card-text class="text-xs-center body-1 grey--text pa-3">
                <em>{{ __('No discourse yet.') }}</em>
            </v-card-text>
        @endif

        @include("Forum::interactives.comments-list", ['comments' => $resource->comments()->paginate(settings('forum_comments_per_page', 5))->items()])

        @if (! $resource->comments()->get()->isEmpty())
            <v-card-text>
                @include("Theme::partials.pagination", ['resources' => $resource->comments()->paginate(settings('forum_comments_per_page', 5))])
            </v-card-text>
        @endif

        <v-divider></v-divider>
        <v-card flat>
            {{-- <v-toolbar card class="transparent">
                <v-toolbar-title>{{ __("Post your comment") }}</v-toolbar-title>
            </v-toolbar> --}}
            {{-- <v-divider></v-divider> --}}
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
                    commentforms: [],
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
                show (e) {
                    let target = e.currentTarget;
                    console.log(target);
                },

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
