@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))
@section("page-title", __(""))

@section("content")
    <v-parallax height="225" src="//placeimg.com/1000/600">
        <v-container fill-height fluid>
            <v-layout fill-height>
                <v-flex xs12 align-end flexbox>
                    <v-card avatar class="pa-1 mr-2" style="width: 100px;">
                        <v-card-media
                            src="//placeimg.com/100/100"
                            height="100"
                        ></v-card-media>
                    </v-card>
                    <div
                        dark
                        class="headline"
                    >
                        <span class="pa-2">{{ user()->displayname }}</span>
                        <v-btn dark icon flat><v-icon>edit</v-icon></v-btn>
                        <br>
                        <strong class="pa-2 caption">{{ user()->email }}</strong>
                    </div>
                </v-flex>
            </v-layout>
        </v-container>
    </v-parallax>
    <v-toolbar class="info" flat extended>
        <v-spacer></v-spacer>
        <v-container fluid>
            <v-flex xs12 flexbox>
                <em class="white--text subheading">{{ user()->bio }} <v-btn dark icon flat><v-icon>edit</v-icon></v-btn></em>
                <v-spacer></v-spacer>
                <v-btn accent class="ma-0 elevation-1">{{ __('Send Message') }}</v-btn>
            </v-flex>
        </v-container>
    </v-toolbar>
    <v-container fluid>
        <v-container fluid>
            <v-layout row>
                <v-flex xs8>
                    <v-card class="card--flex-toolbar mb-3">
                        <v-toolbar card class="white" prominent>
                            <v-toolbar-title class="body-2 grey--text">{{ __('Timeline') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn icon>
                                <v-icon v-badge:3.overlap>mail</v-icon>
                            </v-btn>
                            <v-btn icon>
                                <v-icon class="red--after" v-badge:!.overlap>notifications</v-icon>
                            </v-btn>
                            <v-btn icon>
                                <v-icon>more_vert</v-icon>
                            </v-btn>
                        </v-toolbar>
                        <v-divider></v-divider>
                        <v-card-text style="height: 200px;"></v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs4>
                    <v-card class="card--flex-toolbar mb-3">
                        <v-toolbar card class="white" prominent>
                            <v-toolbar-title class="body-2 grey--text">{{ __('Timeline') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-divider></v-divider>
                        <v-card-text style="height: 200px;"></v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-container>


    <v-container fluid>
        {{-- <v-layout row wrap>
            <v-flex sm6 md8 xs12>

                <v-card class="mb-3 elevation-1">


                    <form action="{{ route('settings.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </form>

                </v-card>

            </v-flex>
        </v-layout> --}}
    </v-container>
    @include("Theme::partials.banner")
@endsection

@push('css')
    <style>
        .card--flex-toolbar {
            margin-top: -97px;
        }
    </style>
@endpush

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        items: {!! json_encode(@$resource) !!},
                        radios: {
                            membership: {
                                items: {!! json_encode(config('auth.registration.modes', [])) !!},
                                model: '{{ @$resource->site_membership ? $resource->site_membership : config('auth.registration.default', 2) }}',
                            },
                            date_format: {
                                custom: 'm/d/Y',
                                model: '{{ @$resource->date_format ? $resource->date_format : config('settings.date_format', 'F d, Y') }}'
                            },
                            time_format: {
                                custom: 'H:i:s a',
                                model: '{{ @$resource->time_format ? $resource->time_format : config('settings.time_format', 'h:s A') }}'
                            }
                        },
                    },
                };
            },
        });
    </script>
@endpush
