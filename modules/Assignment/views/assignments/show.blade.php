@include("Theme::partials.backdrop")
@extends("Theme::layouts.admin")

@section("head-title", __($resource->name))
@section("page-title", __($resource->name))

@section("content")
    @include("Frontier::partials.banner")
    <v-toolbar dark class="light-blue elevation-0" extended>
        <v-spacer></v-spacer>
        <v-btn
            @click.native=""
            ripple
            flat
            >
            <v-icon left dark>reply</v-icon>
            Back
        </v-btn>
    </v-toolbar>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card flat class="transparent">
                    <v-layout row>
                        <v-flex xs10 offset-xs1>
                            <v-card class="card--flex-toolbar">
                                <v-toolbar card prominent class="transparent">
                                    <v-toolbar-title class="title">{{ __($resource->name) }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-menu bottom left>
                                        <v-btn icon flat slot="activator" v-tooltip:bottom="{'html': 'More Actions'}"><v-icon>more_vert</v-icon></v-btn>
                                        <v-list>
                                            <v-list-tile :href="route(urls.assignments.edit, ('{{ $resource->id }}'))">
                                                <v-list-tile-action>
                                                    <v-icon accent>edit</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>
                                                        {{ __('Edit') }}
                                                    </v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                            <v-list-tile
                                                @click.native.stop="destroy(route(urls.assignments.api.destroy, '{{ $resource->id }}'),
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
                                            <div class="grey--text">Trainer</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            Paul Smith
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                             <div class="grey--text">Course</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            DPE
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                             <div class="grey--text">Date Started</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            <div>September 18, 2017 (02:21PM)</div>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                             <div class="grey--text">Date Due</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            <div>September 18, 2017 (02:21PM)</div>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs4>
                                             <div class="grey--text">Status</div>
                                        </v-flex>
                                        <v-flex xs8>
                                            <v-chip label class="ml-0 green white--text">Open</v-chip>
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
                    resource: {
                        item: {!! json_encode($resource) !!},
                        model: false,
                        dialog: {
                            model: false,
                        },
                    },
                    urls: {
                        assignments: {
                            api: {
                                clone: '{{ route('api.assignments.clone', 'null') }}',
                                destroy: '{{ route('api.assignments.destroy', 'null') }}',
                            },
                            show: '{{ route('assignments.show', 'null') }}',
                            edit: '{{ route('assignments.edit', 'null') }}',
                            destroy: '{{ route('assignments.destroy', 'null') }}',
                        },
                    },
                };
            },
            mounted () {
                let self = this;
            }
        })
    </script>
@endpush
