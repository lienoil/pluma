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
                            <input type="hidden" name="site_logo" value="{{ old('site_logo') ? old('site_logo') : settings('site_logo') }}">
                            <v-text-field
                                label="{{ __('Site Title') }}"
                                name="site_title"
                                input-group
                                hide-details
                                value="{{ old('site_title') ? old('site_title') : settings('site_title') }}"
                            ></v-text-field>
                            <v-text-field
                                label="{{ __('Site Tagline') }}"
                                name="site_tagline"
                                input-group
                                hide-details
                                value="{{ old('site_tagline') ? old('site_tagline') : settings('site_tagline') }}"
                            ></v-text-field>
                            <v-text-field
                                label="{{ __('Site Email Address') }}"
                                name="site_email"
                                input-group
                                hide-details
                                value="{{ old('site_email') ? old('site_email') : settings('site_email') }}"
                            ></v-text-field>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Membership') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="site_membership" :value="resource.radios.membership.model">
                                    <v-radio-group v-model="resource.radios.membership.model" :mandatory="true">
                                        <template v-for="(radio, i) in resource.radios.membership.items">
                                            <v-radio hide-details :input-value="i.toString()" :value="i.toString()" :label="radio"></v-radio>
                                        </template>
                                    </v-radio-group>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Date Format') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="date_format" :value="resource.radios.date_format.model">
                                    <v-radio-group hide-details class="mb-0" v-model="resource.radios.date_format.model" :mandatory="true">
                                        <v-radio hide-details input-value="F d, Y" value="F d, Y" label="F d, Y ({{ date('F d, Y') }})"></v-radio>
                                        <v-radio hide-details input-value="Y-m-d" value="Y-m-d" label="Y-m-d ({{ date('Y-m-d') }})"></v-radio>
                                        <v-radio hide-details input-value="Y/m/d" value="Y/m/d" label="Y/m/d ({{ date('Y/m/d') }})"></v-radio>
                                        <v-radio hide-details label="{{ __('Custom Format') }}" hide-details :input-value="resource.radios.date_format.custom" :value="resource.radios.date_format.custom"></v-radio>
                                    </v-radio-group>
                                    <v-text-field
                                        label="{{ __('Custom Date Format') }}"
                                        v-model="resource.radios.date_format.custom"
                                        input-group
                                        hide-details
                                        @input="(val) => { resource.radios.date_format.model = val }"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Time Format') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="time_format" :value="resource.radios.time_format.model">
                                    <v-radio-group hide-details class="mb-0" v-model="resource.radios.time_format.model" :mandatory="true">
                                        <v-radio hide-details input-value="h:i A" value="h:i A" label="h:i A (01:00 PM)"></v-radio>
                                        <v-radio hide-details input-value="H:i:s" value="H:i:s" label="H:i:s (13:00:00)"></v-radio>
                                        <v-radio hide-details label="{{ __('Custom Format') }}" :input-value="resource.radios.time_format.custom" :value="resource.radios.time_format.custom"></v-radio>
                                    </v-radio-group>
                                    <v-text-field
                                        label="{{ __('Custom Time Format') }}"
                                        v-model="resource.radios.time_format.custom"
                                        input-group
                                        hide-details
                                        @input="(val) => { resource.radios.time_format.model = val }"
                                    ></v-text-field>
                                    <div class="caption grey--text">
                                        {{ __('Format follows constants from') }} <a target="_blank" href="http://php.net/manual/en/function.date.php">{{ __('PHP Date Format Manual') }}</a>
                                    </div>
                                </v-flex>
                            </v-layout>
                        </v-card-text>

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
                                model: '{{ settings('site_membership', 2) }}',
                            },
                            date_format: {
                                custom: 'm/d/Y',
                                model: '{{ @$resource->date_format ? $resource->date_format : settings('date_format', 'F d, Y') }}'
                            },
                            time_format: {
                                custom: 'H:i:s a',
                                model: '{{ @$resource->time_format ? $resource->time_format : settings('time_format', 'h:i A') }}'
                            }
                        },
                    },
                };
            },
        });
    </script>
@endpush
