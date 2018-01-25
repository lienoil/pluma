@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>
                {{-- @php
                    echo "<pre>";
                        var_dump( navigations('current') ); die();
                    echo "</pre>";
                @endphp --}}
                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm9 md5>

                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Displaying Data') }}</v-toolbar-title>
                        </v-toolbar>
                        <v-subheader>{{ __('Time Format') }}</v-subheader>
                        <v-card-text>
                            <input type="hidden" name="time_format" :value="resource.radios.time_format.model">
                            <v-radio-group hide-details class="mb-0" v-model="resource.radios.time_format.model" :mandatory="true">
                                <v-radio input-value="h:i A" value="h:i A" label="h:i A (01:00 PM)"></v-radio>
                                <v-radio input-value="H:i:s" value="H:i:s" label="H:i:s (13:00:00)"></v-radio>
                                <v-radio label="{{ __('Custom Format') }}" :input-value="resource.radios.time_format.custom" :value="resource.radios.time_format.custom"></v-radio>
                            </v-radio-group>
                            <v-text-field
                                label="{{ __('Custom Time Format') }}"
                                v-model="resource.radios.time_format.custom"
                                input-group
                                hide-details
                                @input="(val) => { resource.radios.time_format.model = val }"
                            ></v-text-field>

                            <div class="caption grey--text">{{ __('Format follows constants from') }} <a target="_blank" href="http://php.net/manual/en/function.date.php">{{ __('PHP Date Format Manual') }}</a></div>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>

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
                                model: '{{ old('time_format') ?? settings('time_format') }}'
                            }
                        },
                    },
                };
            },
        });
    </script>
@endpush
