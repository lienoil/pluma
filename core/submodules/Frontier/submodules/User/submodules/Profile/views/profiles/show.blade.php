@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))

@section("content")
    <v-parallax height="225" src="https://source.unsplash.com/1600x900/?nature,water">
        <v-container fill-height fluid>
            <v-layout fill-height>
                <v-flex xs12 align-end flexbox>
                    <v-card avatar class="pa-1 mr-2" style="width: 100px;">
                        <v-card-media
                            src="{{ $resource->avatar }}"
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
                    <v-spacer></v-spacer>
                    @can('update', $resource)
                    <v-btn accent dark outline>{{ __('Change Backdrop') }}</v-btn>
                    @endcan
                </v-flex>
            </v-layout>
        </v-container>
    </v-parallax>
    <v-toolbar class="info" flat extended>
        <v-spacer></v-spacer>
        <v-container fluid grid-list-lg>
            <v-flex xs12 flexbox>
                <em class="white--text subheading">{{ user()->bio }} <v-btn dark icon flat><v-icon>edit</v-icon></v-btn></em>
                <v-spacer></v-spacer>
                <v-btn accent class="ma-0 elevation-1">{{ __('Send Message') }}</v-btn>
            </v-flex>
        </v-container>
    </v-toolbar>
    <v-container fluid>
        <v-container fluid grid-list-lg>
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


    <v-container fluid grid-list-lg>
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
                    },
                };
            },
        });
    </script>
@endpush
