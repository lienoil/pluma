@extends("Frontier::layouts.admin")

@push("utilitybar")
    {{-- @include("Frontier::partials.loading") --}}
@endpush

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline">
                <v-icon>{{ $application->page->icon }}</v-icon>
                {{ __($application->page->title) }}
            </h5>
            <p class="grey--text">{{ __("Edit Grant here.") }}</p>
        </v-card-text>
    </v-layout>
@endpush

@section("content")
    <v-layout row wrap>
        <v-flex sm8>
            <form id="editGrantForm" class="form form--edit">
                <v-card class="lighten-4 grey--text elevation-1 mb-2">
                    <v-toolbar class="primary lighten-2 elevation-0">
                        <v-toolbar-title class="white--text">{{ __('Edit Grant') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                            name="name"
                            label="Name"
                            value="{{ $resource->name }}"
                        ></v-text-field>
                        <v-text-field
                            name="code"
                            label="Code"
                            value="{{ $resource->code }}"
                        ></v-text-field>
                        <v-text-field
                            name="description"
                            label="Description"
                            value="{{ $resource->description }}"
                        ></v-text-field>
                    </v-card-text>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-card class="elevation-0">
                                <v-card-text class="grey--text text--darken-2 grey lighten-5">
                                    {{ __('Permissions') }}
                                    <v-spacer></v-spacer>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs6>
                                            <v-card-title><p class="text-xs-center mb-0">Available</p></v-card-title>

                                            <draggable
                                                :element="'table'"
                                                v-model="availables"
                                                {{-- :options="{group:'people'}" --}}
                                                @start="drag=true"
                                                @end="drag=false"
                                            >
                                                <tr v-for="av in availables"></tr>
                                            </draggable>

                                            {{-- @foreach ($permissions as $id => $code)
                                                <p>{{ $code }}</p>
                                            @endforeach --}}
                                        </v-flex>
                                        <v-flex xs6>
                                            <v-card-title><p class="text-xs-center mb-0">Selected</p></v-card-title>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-card-text>
                        <v-btn primary>Submit</v-btn>
                    </v-card-text>
                </v-card>
            </form>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendor/vue/draggable/draggable.min.js') }}"></script>
    <script>
        Vue.component('draggable', draggable);

        mixins.push({
            data () {
                return {
                    availables: {!! json_encode($permissions) !!},
                };
            },
            components: {
                draggable: draggable,
            }
        })
    </script>
@endpush
