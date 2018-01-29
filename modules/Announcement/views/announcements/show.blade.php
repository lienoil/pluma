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

                                    {{-- btn actions --}}
                                    <v-btn v-tooltip:left="{'html': 'Edit'}" :href="route(urls.announcements.edit, ('{{ $resource->id }}'))" icon>
                                        <v-icon>mode_edit</v-icon>
                                    </v-btn>
                                    <form action="{{ route('announcements.destroy', $resource->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <v-btn type="submit" v-tooltip:left="{'html': 'Move to Trash'}" icon>
                                            <v-icon>delete</v-icon>
                                        </v-btn>
                                    </form>
                                    {{-- //btn actions --}}
                                </v-toolbar>
                                <v-divider></v-divider>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                            <div class="grey--text">{{ __('Scheduled') }}</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            {{ $resource->published }}
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                            <div class="grey--text">{{ __('Expires') }}</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            {{ __($resource->expired) }}
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>

                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                            <div class="grey--text">{{ __('Description') }}</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            <div>{!! $resource->body !!}</div>
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
                                destroy: '{{ route('announcements.destroy', 'null') }}',
                            },
                            show: '{{ route('announcements.show', 'null') }}',
                            edit: '{{ route('announcements.edit', 'null') }}',
                            destroy: '{{ route('announcements.destroy', 'null') }}',
                        },
                    },
                };
            },
            methods: {
                get () {
                    //
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            console.log('lops',data);
                            // self.get('{{ route('api.announcements.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data);
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
