@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex md3 sm6>
                <multi-purpose-calendar color="success" class="elevation-1" :date="dates" :config="{mode:'multiple'}"></multi-purpose-calendar>
            </v-flex>
            <v-flex md8 sm6>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="subheading">{{ __('New Timesheet') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="grey lighten-4">
                        <v-card class="elevation-1 mb-2" :key="i" v-for="(date, i) in dates.split(',')">
                            <v-card-text class="subheading" v-html="date.trim()"></v-card-text>
                            <v-card-text class="subheading">
                                <v-text-field></v-text-field>
                            </v-card-text>
                        </v-card>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('timesheet/vue-multi-datepicker/dist/vue-multi-datepicker.min.css?v='.date('H_i_s')) }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('timesheet/vue-date-range/moment.min.js') }}"></script>
    <script src="{{ assets('timesheet/vue-multi-datepicker/dist/vue-multi-datepicker.min.js?v='.date('H_i_s')) }}"></script>
    {{-- <script src="{{ assets('timesheet/mixins/vue-date-range.js?v=13s') }}"></script> --}}
    <script>
        mixins.push({
            data () {
                return {
                    dates: '',
                    config: {},
                }
            }
        });
    </script>
@endpush
