@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid>
        @include("Theme::partials.banner")
        <v-layout row wrap>
            <v-flex sm6 md8 xs12 offset-md2>

                <v-card class="mb-3 elevation-1">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('General Settings') }}</v-toolbar-title>
                    </v-toolbar>

                    <form action="{{ route('settings.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                            <v-text-field
                                label="{{ __('Site Title') }}"
                                name="site_title"
                                input-group
                                hide-details
                                value="{{ old('site_title') ? old('site_title') : @$resource->site_title }}"
                            ></v-text-field>
                            <v-text-field
                                label="{{ __('Site Tagline') }}"
                                name="site_tagline"
                                input-group
                                hide-details
                                value="{{ old('site_tagline') ? old('site_tagline') : @$resource->site_tagline }}"
                            ></v-text-field>
                            <v-text-field
                                label="{{ __('Site Email Address') }}"
                                name="site_email"
                                input-group
                                hide-details
                                value="{{ old('site_email') ? old('site_email') : @$resource->site_email }}"
                            ></v-text-field>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Membership') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="site_membership" :value="resource.radios.membership.model">
                                    <template v-for="(radio, i) in resource.radios.membership.items">
                                        <v-radio hide-details v-model="resource.radios.membership.model" :input-value="i" :value="i" :label="radio"></v-radio>
                                    </template>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Date Format') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="date_format" :value="resource.radios.date_format.model">
                                    <v-radio hide-details v-model="resource.radios.date_format.model" input-value="F d, Y" value="F d, Y" label="F d, Y - ({{ date('F d, Y') }})"></v-radio>
                                    <v-radio hide-details v-model="resource.radios.date_format.model" input-value="Y-m-d" value="Y-m-d" label="Y-m-d - ({{ date('Y-m-d') }})"></v-radio>
                                    <v-radio hide-details v-model="resource.radios.date_format.model" input-value="Y/m/d" value="Y/m/d" label="Y/m/d - ({{ date('Y/m/d') }})"></v-radio>

                                    <v-layout row wrap>
                                        <v-flex xs1>
                                            <v-radio hide-details v-model="resource.radios.date_format.model" :input-value="resource.radios.date_format.custom" :value="resource.radios.date_format.custom"></v-radio>
                                        </v-flex>
                                        <v-flex xs11>
                                            <v-text-field
                                                label="{{ __('Custom') }}"
                                                v-model="resource.radios.date_format.custom"
                                                input-group
                                                hide-details
                                                @input="(val) => { resource.radios.date_format.model = val }"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Time Format') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="time_format" :value="resource.radios.time_format.model">
                                    <v-radio hide-details v-model="resource.radios.time_format.model" input-value="h:s A" value="h:s A" label="h:s A - ({{ date('h:s A') }})"></v-radio>
                                    <v-radio hide-details v-model="resource.radios.time_format.model" input-value="H:i:s" value="H:i:s" label="H:i:s - ({{ date('H:i:s') }})"></v-radio>

                                    <v-layout row wrap>
                                        <v-flex xs1>
                                            <v-radio hide-details v-model="resource.radios.time_format.model" :input-value="resource.radios.time_format.custom" :value="resource.radios.time_format.custom"></v-radio>
                                        </v-flex>
                                        <v-flex xs11>
                                            <v-text-field
                                                label="{{ __('Custom') }}"
                                                v-model="resource.radios.time_format.custom"
                                                input-group
                                                hide-details
                                                @input="(val) => { resource.radios.time_format.model = val }"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </form>

                </v-card>

            </v-flex>
        </v-layout>
    </v-container>
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
