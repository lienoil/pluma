@extends("Theme::layouts.admin")

@section("head-title", __('Edit Announcement'))
@section("page-title", __('Edit Announcement'))

@section("content")
    @include('Theme::partials.banner')
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <form action="{{ route('announcements.update', $resource->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <v-card class="elevation-1">
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Edit Announcement') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="{{ __('Title') }}"
                                name="name"
                                value="{{ $resource->name }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.code"
                                hint="{{ __('Will be used as a slug for Announcement. Make sure the code is unique.') }}"
                                label="{{ __('Code') }}"
                                name="code"
                                :value="resource.item.name ? resource.item.name : '{{ $resource->code }}' | slugify"
                            ></v-text-field>

                            <v-dialog
                                persistent
                                v-model="modal"
                                lazy
                                full-width
                                >
                                <v-text-field
                                    slot="activator"
                                    :error-messages="resource.errors.schedule"
                                    label="{{ __('Schedule') }}"
                                    v-model="schedule"
                                    name="schedule"
                                    value="{{ $resource->schedule }}"
                                    readonly
                                ></v-text-field>
                                <v-date-picker
                                    v-model="schedule"
                                    scrollable
                                    >
                                    <template scope="{ save, cancel }">
                                        <v-card-actions>
                                            <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                            <v-btn flat primary @click.native="save()">Save</v-btn>
                                        </v-card-actions>
                                    </template>
                                </v-date-picker>
                            </v-dialog>
                        </v-card-text>

                        @include("Theme::interactive.editor")

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" class="primary">{{ __('Update') }}</v-btn>
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
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    schedule: "{{ $resource->schedule }}",
                    menu: false,
                    modal: false,
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            schedule: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },

            mounted () {
                // this.mountSuppliments();
            }
        })
    </script>
@endpush
