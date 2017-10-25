{{-- reply --}}
<v-card class="elevation-1">
    <v-toolbar class="transparent elevation-0">
        <v-toolbar-title>{{ __("Comments/Queries") }}</v-toolbar-title>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text class="pa-0 pb-3">
        <v-card-text class="pa-0">
            <v-card class="elevation-0">
                <v-quill v-model="quill.comment"></v-quill>
                <v-divider></v-divider>
                <v-card-text class="text-xs-right pa-0">
                    <v-btn flat primary class="primary--text">Post a comment</v-btn>
                </v-card-text>
            </v-card>
        </v-card-text>
        <v-divider></v-divider>
        <v-list two-line>
            <v-list-tile avatar>
                <v-list-tile-avatar>
                    <img src="https://placeimg.com/640/480/any" />
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title><a href="#!" class="teal--text text-decor-none"><strong>Jane Doe</strong></a></v-list-tile-title>
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
            <div class="pl-7 pr-4 grey--text text--darken-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt harum officia non nisi, veniam repellendus commodi libero atque in, quis quam facere sapiente, consequatur dolores. Quam aspernatur libero sit dolore!</div>
        </v-list>
    </v-card-text>
</v-card>

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    <style>
        .text-decor-none {
            text-decoration: none;
        }
        .pl-7 {
            padding-left: 70px;
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
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('test/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    quill: {
                        comment: {}
                    },
                }
            },
        })
    </script>
@endpush
