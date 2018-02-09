@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="grey darken-4 elevation-0">
        <v-icon class="white--text">{{ navigations('current')->icon }}</v-icon>
        <v-toolbar-title class="white--text">{{ __('System Information') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg class="grey darken-3">

        <v-layout row wrap>

            <v-flex sm3 md2>
                @include("Setting::partials.settingsbar")
            </v-flex>

            <v-flex sm7 md5>
                <form action="{{ route('settings.system.configuration.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card flat dark class="transparent">
                        <v-subheader dark>{{ __('Configuration') }}</v-subheader>
                        <v-card-text>
                            <v-text-field
                                dark
                                hint="{{ __('Generate via "blacksmith/blackmith key:generate".') }}"
                                label="{{ __('Application Key') }}"
                                readonly
                                persistent-hint
                                value="{{ settings('APP_KEY', config('encryption.key', env('APP_KEY'))) }}"
                            ></v-text-field>

                            <v-switch
                                dark
                                :label="`{{ __('Debug Mode: ' . (v("resource.item.APP_DEBUG ? 'ON' : 'OFF'", true) )) }}`"
                                v-model="resource.item.APP_DEBUG"
                            ></v-switch>
                            <input type="hidden" name="APP_DEBUG" v-model="resource.item.APP_DEBUG">
                        </v-card-text>
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
                            APP_DEBUG: '{{ old('APP_DEBUG') ?? settings('APP_DEBUG', config('debugging.debug')) }}',
                        }
                    }
                }
            }
        })
    </script>
@endpush
