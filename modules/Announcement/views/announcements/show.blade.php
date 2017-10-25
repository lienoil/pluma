@extends("Theme::layouts.admin")

@section("head-title", __($resource->name))
@section("page-title", __($resource->name))

@section("content")
    @include("Theme::partials.banner")
    <v-toolbar dark extended class="light-blue elevation-0">
        <v-btn
            href="{{ route('announcements.index') }}"
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card flat class="transparent">
                    <v-layout row wrap>
                        <v-flex md8 offset-md2 xs12>
                            <v-card class="card--flex-toolbar">
                                <v-toolbar card prominent class="transparent">
                                    <v-toolbar-title class="title">{{ __($resource->name) }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-menu bottom left>
                                        <v-btn icon flat slot="activator" v-tooltip:bottom="{'html': 'More Actions'}"><v-icon>more_vert</v-icon></v-btn>
                                        <v-list>
                                            <v-list-tile ripple :href="route(urls.announcements.edit, ('{{ $resource->id }}'))">
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
                                                @click="destroy(route(urls.announcements.api.destroy),
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
                                <v-divider></v-divider>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                            <div class="grey--text">Schedule</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            September 12, 2017
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                            <div class="grey--text">Created</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            September 01, 2017
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                            <div class="grey--text">Last Modified</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            September 05, 2017
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                            <div class="grey--text">Description</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            <div>{{ $resource->description }}</div>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .card--flex-toolbar {
            margin-top: -80px;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    bulk: {
                        destroy: {
                            model: false,
                        },
                        searchform: {
                            model: false,
                        },
                    },
                    resource: {
                        item: {!! json_encode($resource) !!},
                        model: false,
                        dialog: {
                            model: false,
                        },
                    },
                    urls: {
                        announcements: {
                            api: {
                                clone: '{{ route('api.announcements.clone', 'null') }}',
                                destroy: '{{ route('api.announcements.destroy', 'null') }}',
                            },
                            show: '{{ route('announcements.show', 'null') }}',
                            edit: '{{ route('announcements.edit', 'null') }}',
                            destroy: '{{ route('announcements.destroy', 'null') }}',
                        },
                    },
                };
            },
            methods: {
                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.announcements.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },
            },
            mounted () {
                let self = this;
            }
        })
    </script>
@endpush
