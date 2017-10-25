@extends("Theme::layouts.admin")

@section("head-title", __('Create Announcement'))
@section("page-title", __('Create Announcement'))


@section("content")
    @include("Theme::partials.banner")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="elevation-1">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Create Announcement') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <form action="{{ route('announcements.store') }}" method="POST">
                            {{ csrf_field() }}

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Title') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-text-field
                                        :error-message="resource.errors.name"
                                        label="{{ _('Title') }}"
                                        name="name"
                                        value="{{ old('name') }}"
                                        @input="(val) => { resource.item.name = val; }"
                                    >
                                    </v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Code') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-text-field
                                        :error-messages="resource.errors.code"
                                        :value="resource.item.name ? resource.item.name : '{{ old('code') }}' | slugify"
                                        hint="{{ __('Will be used as a slug for Announcement. Make sure the code is unique.') }}"
                                        label="{{ _('Code') }}"
                                        name="code"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Description') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-text-field
                                        :error-messages="resource.errors.description"
                                        label="{{ _('Short Description') }}"
                                        name="description"
                                        value="{{ old('description') }}"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs4>
                                    <v-subheader>{{ __('Schedule') }}</v-subheader>
                                </v-flex>
                                <v-flex xs8>
                                    <v-dialog
                                        persistent
                                        v-model="modal"
                                        lazy
                                        full-width
                                        >
                                        <v-text-field
                                            slot="activator"
                                            :error-messages="resource.errors.schedule"
                                            label="{{ _('Pick a schedule') }}"
                                            v-model="schedule"
                                            name="schedule"
                                            value="{{ old('schedule') }}"
                                            readonly
                                        ></v-text-field>
                                        <v-date-picker v-model="schedule" scrollable>
                                            <template scope="{ save, cancel }">
                                                <v-card-actions>
                                                    <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                                    <v-btn flat primary @click.native="save()">Save</v-btn>
                                                </v-card-actions>
                                            </template>
                                        </v-date-picker>
                                    </v-dialog>
                                </v-flex>
                            </v-layout>

                            <div class="text-sm-right">
                                <button type="submit" class="btn btn--raised primary ma-0"><span class="btn__content">{{ __('Submit') }}</span></button>
                            </div>
                        </form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .inline {
            display: inline-block;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    dataset: {
                        items: [],
                        loading: true,
                        selected: [],
                        totalItems: 0,
                    },
                    schedule: null,
                    menu: false,
                    modal: false,
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    urls: {
                        announcements: {
                            show: '{{ route('announcements.show', 'null') }}',
                            edit: '{{ route('announcements.edit', 'null') }}',
                            destroy: '{{ route('announcements.destroy', 'null') }}',
                        },
                    },
                };
            },

            mounted () {
                this.get();
                this.mountSuppliments();
                // console.log("dataset.pagination", this.dataset.pagination);
            },
        });
    </script>
@endpush
