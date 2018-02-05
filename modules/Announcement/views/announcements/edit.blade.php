@extends("Theme::layouts.admin")

@section("head-title", __('Edit Announcement'))

@section("content")
    <v-container fluid grid-list-lg>
        <form action="{{ route('announcements.update', $resource->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @include("Theme::partials.banner")

            <v-layout row wrap>
                <v-flex sm7 md9>
                    <v-card class="elevation-1">
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Edit Announcement') }}</v-toolbar-title>
                        </v-toolbar>

                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="{{ _('Name') }}"
                                name="name"
                                value="{{ $resource->name }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.code"
                                :value="resource.item.name ? resource.item.name : '{{ $resource->code }}' | slugify"
                                hint="{{ __('Will be used as a slug for Announcement. Make sure the code is unique.') }}"
                                label="{{ _('Code') }}"
                                name="code"
                            ></v-text-field>
                        </v-card-text>

                        @include("Theme::interactive.editor")
                    </v-card>

                </v-flex>

                <v-flex sm5 md3>
                    @section("cards.saving.fields")
                        <v-switch label="{{ __('Publish Now') }}" v-model="resource.publish_now"></v-switch>

                        <template>
                            <v-dialog persistent lazy full-width>
                                <v-text-field
                                    slot="activator"
                                    :error-messages="resource.errors.published_at"
                                    label="{{ _('Publication Date') }}"
                                    v-model="resource.item.published_at"
                                    name="published_at"
                                    hint="{{ __('This announcement will appear at the Announcement Boards at this specified date') }}"
                                    persistent-hint
                                    readonly
                                    prepend-icon="fa-calendar"
                                ></v-text-field>
                                <div>
                                    <v-date-picker v-if="resource.publish_toggle" v-model="resource.publish_date" scrollable>
                                        <template scope="{ save, cancel }">
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn icon @click.native="resource.publish_toggle = !resource.publish_toggle"><v-icon>access_time</v-icon></v-btn>
                                            </v-card-actions>
                                        </template>
                                    </v-date-picker>
                                    <v-time-picker v-else v-model="resource.publish_time" scrollable>
                                        <template scope="{ save, cancel }">
                                            <v-card-actions>
                                                <v-btn icon @click.native="resource.publish_toggle = !resource.publish_toggle"><v-icon>date_range</v-icon></v-btn>
                                                <v-spacer></v-spacer>
                                                <v-btn flat primary @click.native.stop="cancel">{{ __('Cancel') }}</v-btn>
                                                <v-btn flat primary @click.native="save();resource.publish_now=false;">{{ __('Save') }}</v-btn>
                                            </v-card-actions>
                                        </template>
                                    </v-time-picker>
                                </div>
                            </v-dialog>
                        </template>

                        <v-dialog persistent lazy full-width>

                            <v-text-field
                                slot="activator"
                                :error-messages="resource.errors.expired_at"
                                label="{{ _('Expiration Date') }}"
                                v-model="resource.item.expired_at"
                                {{-- :value="`${resource.expire_date} ${resource.expire_time}`" --}}
                                name="expired_at"
                                hint="{{ __('If date is specified, this announcement will automatically be removed from the Announcement Boards') }}"
                                persistent-hint
                                readonly
                                prepend-icon="delete"
                            ></v-text-field>
                            <div>
                                <v-date-picker v-if="resource.expire_toggle" :allowed-dates.sync="allowedDates" v-model="resource.expire_date" scrollable>
                                    <template scope="{ save, cancel }">
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn icon @click.native="resource.expire_toggle = !resource.expire_toggle"><v-icon>access_time</v-icon></v-btn>
                                        </v-card-actions>
                                    </template>
                                </v-date-picker>
                                <v-time-picker v-else v-model="resource.expire_time" scrollable>
                                    <template scope="{ save, cancel }">
                                        <v-card-actions>
                                            <v-btn icon @click.native="resource.expire_toggle = !resource.expire_toggle"><v-icon>date_range</v-icon></v-btn>
                                            <v-spacer></v-spacer>
                                            <v-btn flat primary @click.native.stop="cancel">{{ __('Cancel') }}</v-btn>
                                            <v-btn flat primary @click.native="save()">{{ __('Save') }}</v-btn>
                                        </v-card-actions>
                                    </template>
                                </v-time-picker>
                            </div>
                        </v-dialog>
                    @endsection

                    @include("Theme::cards.saving")

                    @include("Theme::interactives.featured-image")

                    @include("Theme::cards.category")
                </v-flex>
            </v-layout>
        </form>
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
                        item: {!! json_encode($resource) !!},
                        quill: {
                            html: '{!! $resource->body !!}',
                            delta: {!! $resource->delta !!}
                        },
                        publish_now: false,
                        publish_date: '',
                        publish_time: '',
                        publish_toggle: true,
                        expire_date: '',
                        expire_time: '',
                        expire_toggle: true,
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },

            mounted () {
                // console.log(this.resource.item);
            },
            methods: {
                'allowedDates': function (date) {
                    if (this.resource.publish_date) {
                        console.log(moment(date).format('YYYY-MM-DD'), '>=',moment(new Date(this.resource.publish_date)).format('YYYY-MM-DD'));
                        return moment(date).format('YYYY-MM-DD') >= moment(new Date(this.resource.publish_date)).format('YYYY-MM-DD');
                    }

                    return true;
                }
            },
            watch: {
                'resource.expire_date': function (val) {
                    this.resource.item.expired_at = val + " " + this.resource.expire_time;
                },
                'resource.expire_time': function (val) {
                    this.resource.item.expired_at = this.resource.expire_date + " " + val;
                },
                'resource.publish_date': function (val) {
                    this.resource.item.published_at = val + " " + this.resource.publish_time;
                },
                'resource.publish_time': function (val) {
                    this.resource.item.published_at = this.resource.publish_date + " " + val;
                },
                'resource.publish_now': function (val) {
                    if (val) {
                        this.resource.item.published_at = moment(new Date()).format('YYYY-MM-DD hh:mma');
                    }
                }
            }
        })
    </script>
@endpush
