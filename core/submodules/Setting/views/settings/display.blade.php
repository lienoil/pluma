@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>

                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm9 md5>

                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Displaying Data') }}</v-toolbar-title>
                        </v-toolbar>
                        {{-- <v-subheader>{{ __('Data') }}</v-subheader> --}}
                        <v-card-text>
                            <v-text-field
                                type="number"
                                label="{{ __('Items Per Page') }}"
                                v-model="resource.item.items_per_page"
                                name="items_per_page"
                                hint="{{ __('Default: 15 items') }}"
                                persistent-hint
                                input-group
                                @input="(val) => { resource.item.items_per_page = val }"
                            ></v-text-field>

                            <v-text-field
                                type="number"
                                label="{{ __('Excerpt Length') }}"
                                v-model="resource.item.excerpt_length"
                                suffix="{{ __('words') }}"
                                name="excerpt_length"
                                hint="{{ __('Default: 30 words') }}"
                                persistent-hint
                                input-group
                                @input="(val) => { resource.item.excerpt_length = val }"
                            ></v-text-field>
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
                        item: {
                            items_per_page: '{{ old('items_per_page') ?? settings('items_per_page', 15) }}',
                            excerpt_length: '{{ old('excerpt_length') ?? settings('excerpt_length', 30) }}',
                        },
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
