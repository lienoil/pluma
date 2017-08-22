@extends("Theme::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm6 md8 xs12>

            <v-card class="mb-3 elevation-1">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text">{{ __('Profile Settings') }}</v-toolbar-title>
                </v-toolbar>

                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card-text>
                        {{--  --}}
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                    </v-card-actions>
                </form>

            </v-card>

        </v-flex>
    </v-layout>
@endsection

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
