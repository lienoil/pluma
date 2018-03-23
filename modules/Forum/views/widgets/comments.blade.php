<a name="comments"></a>
<v-card flat class="transparent">
    <v-toolbar class="transparent elevation-0">
        <v-toolbar-title class="page-title subheading">{{ __("Post a comment") }}</v-toolbar-title>
    </v-toolbar>
    <v-divider></v-divider>

    {{-- Comments Section --}}
    <v-card-text class="transparent pr-4">
        @include("Content::partials.comments-list", ['comments' => $resource->comments()->parents()->paginate()->items()])
    </v-card-text>
    {{-- Comments Section --}}

    {{-- Pagination --}}
    <v-card-actions>
        <v-spacer></v-spacer>
        @include("Theme::partials.pagination", ['resources' => $resource->comments()->paginate(), 'section' => '#comments'])
        <v-spacer></v-spacer>
    </v-card-actions>
    {{-- Pagination --}}

    <v-divider></v-divider>

    <a name="post-comments"></a>
    <v-card flat class="transparent">
        <v-toolbar card dense class="transparent">
            <v-toolbar-title class="subheading page-title">{{ __('Post Comment') }}</v-toolbar-title>
        </v-toolbar>

        @if (user())
            @can('post-comment')
                <v-alert info v-show="'true'" v-model="alert" dismissible>
                    {{ __('Please observe proper guidelines when posting comments.') }}
                </v-alert>
            @else
                <v-alert warning v-show="'true'" v-model="alert" dismissible>
                    {{ __('Your credentials does not meet the requirements to post comments.') }}
                </v-alert>
            @endcan
        @else
            <v-alert info v-show="'true'" v-model="alert" dismissible>
                {{ __('Login to post comments.') }}
            </v-alert>
        @endif

        <form action="{{ route('forums.comment', $resource->id) }}" method="POST">
            {{ csrf_field() }}
            {{-- <input type="hidden" name="user_id" value="{{ user()->id }}"> --}}
            <input type="hidden" name="type" value="forums">

            {{-- editor --}}
            @include("Content::widgets.editor")
            {{-- editor --}}

            <v-divider></v-divider>

            <v-card-actions>
                @if(user())
                    @can('post-comment')
                        <v-spacer></v-spacer>
                        <v-btn type="submit" flat primary>{{ __('Post Comment') }}</v-btn>
                    @endcan
                @else
                    <span class="pa-2 body-1 grey--text"><a class="td-n" href="{{ route('login.show', ['redirect_to' => route('forums.show', $resource->slug) . '#post-comments']) }}">{{ __('Login') }}</a> {{ __('and join the discourse.') }}</span>
                    <v-spacer></v-spacer>
                    <v-btn disabled flat primary>{{ __('Post Comment') }}</v-btn>
                @endif
            </v-card-actions>
        </form>
        <v-divider></v-divider>
    </v-card>
</v-card>

@push('css')
    {{-- <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    {{-- <style>
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
    </style> --}}
@endpush

@push('pre-scripts')
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
                    hidden: true,
                }
            },
        })
    </script>
@endpush
