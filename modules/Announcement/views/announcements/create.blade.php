@extends("Theme::layouts.admin")

@section("head-title", __('Create Announcement'))
@section("page-title", __('Create Announcement'))


@section("content")
    @include("Theme::partials.banner")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <form action="{{ route('announcements.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="elevation-1">
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Create Announcement') }}</v-toolbar-title>
                        </v-toolbar>

                        <v-card-text>
                            <v-text-field
                                :error-message="resource.errors.name"
                                label="{{ _('Name') }}"
                                name="name"
                                value="{{ old('name') }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.code"
                                :value="resource.item.name ? resource.item.name : '{{ old('code') }}' | slugify"
                                hint="{{ __('Will be used as a slug for Announcement. Make sure the code is unique.') }}"
                                label="{{ _('Code') }}"
                                name="code"
                            ></v-text-field>

                            <v-layout row wrap>
                                <v-flex sm4 xs12>
                                    <v-subheader>{{ __('Schedule') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8 xs12>
                                    <v-dialog
                                        persistent
                                        lazy
                                        full-width
                                    >
                                        <v-text-field
                                            slot="activator"
                                            :error-messages="resource.errors.starts_at"
                                            label="{{ _('Start date') }}"
                                            v-model="resource.starts_at"
                                            name="starts_at"
                                            value="{{ old('starts_at') }}"
                                            hint="{{ __('The date to publish this announcement') }}"
                                            persistent-hint
                                            readonly
                                        ></v-text-field>
                                        <v-date-picker v-model="resource.starts_at" scrollable>
                                            <template scope="{ save, cancel }">
                                                <v-card-actions>
                                                    <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                                    <v-btn flat primary @click.native="save()">Save</v-btn>
                                                </v-card-actions>
                                            </template>
                                        </v-date-picker>
                                    </v-dialog>

                                    <v-dialog
                                        persistent
                                        lazy
                                        full-width
                                    >
                                        <v-text-field
                                            slot="activator"
                                            :error-messages="resource.errors.start_time"
                                            label="{{ _('Start Time') }}"
                                            v-model="resource.start_time"
                                            name="start_time"
                                            value="{{ old('start_time') }}"
                                            hint="{{ __('The time to publish this announcement') }}"
                                            persistent-hint
                                            readonly
                                        ></v-text-field>
                                        <v-time-picker v-model="resource.start_time" scrollable>
                                            <template scope="{ save, cancel }">
                                                <v-card-actions>
                                                    <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                                    <v-btn flat primary @click.native="save()">Save</v-btn>
                                                </v-card-actions>
                                            </template>
                                        </v-time-picker>
                                    </v-dialog>

                                    <v-dialog
                                        persistent
                                        lazy
                                        full-width
                                    >
                                        <v-text-field
                                            slot="activator"
                                            :error-messages="resource.errors.expires_at"
                                            label="{{ _('Expire date') }}"
                                            v-model="resource.expires_at"
                                            name="expires_at"
                                            value="{{ old('expires_at') }}"
                                            hint="{{ __('The date of expiration') }}"
                                            persistent-hint
                                            readonly
                                        ></v-text-field>
                                        <v-date-picker :allowed-dates.sync="allowedDates" v-model="resource.expires_at" scrollable>
                                            <template scope="{ save, cancel }">
                                                <v-card-actions>
                                                    <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                                    <v-btn flat primary @click.native="save()">Save</v-btn>
                                                </v-card-actions>
                                            </template>
                                        </v-date-picker>
                                    </v-dialog>

                                    <v-dialog
                                        persistent
                                        v-model="modal"
                                        lazy
                                        full-width
                                    >
                                        <v-text-field
                                            slot="activator"
                                            :error-messages="resource.errors.expire_time"
                                            label="{{ _('Expire Time') }}"
                                            v-model="resource.expire_time"
                                            name="expire_time"
                                            value="{{ old('expire_time') }}"
                                            hint="{{ __('The time to expire this announcement') }}"
                                            persistent-hint
                                            readonly
                                        ></v-text-field>
                                        <v-time-picker v-model="resource.expire_time" scrollable>
                                            <template scope="{ save, cancel }">
                                                <v-card-actions>
                                                    <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                                    <v-btn flat primary @click.native="save()">Save</v-btn>
                                                </v-card-actions>
                                            </template>
                                        </v-time-picker>
                                    </v-dialog>
                                </v-flex>
                            </v-layout>

                        </v-card-text>

                        @include("Theme::interactive.editor")

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" class="primary elevation-1">{{ __('Submit') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.4/moment.min.js"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    schedule: "",
                    menu: false,
                    modal: false,
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            schedule: '',
                        },
                        starts_at: '',
                        start_time: '',
                        expires_at: '',
                        expire_time: '',
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },

            mounted () {
                //
            },
            methods: {
                'allowedDates': function (date) {
                    if (this.resource.starts_at) {
                        return moment(date).format('YYYY-MM-DD') >= moment(new Date(this.resource.starts_at)).format('YYYY-MM-DD');
                    }

                    return true;
                }
            }
        })
    </script>
@endpush
