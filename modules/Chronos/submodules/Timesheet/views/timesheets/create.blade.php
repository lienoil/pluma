@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex md4>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title primary-title class="subheading">{{ __('Calendar') }}</v-toolbar-title>
                    </v-toolbar>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <daterange :first-day-of-week="{{ settings('first_day_of_the_week', 1) }}" class="calendar" v-model="vueDateRange.range" :lang="vueDateRange.lang" @change="onVueDateRangeChange"></daterange>

                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex sm8>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title primary-title class="subheading">{{ __('Selected Dates') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <p class="subheading"><span v-html="`{{ __('You have selected ') }}${vueDateRange.range.startDate.format('MMMM Do')} - ${vueDateRange.range.endDate.format('MMMM Do')} ${vueDateRange.range.endDate.format('YYYY')}`"></span></p>
                    </v-card-text>
                    <template v-for="(date, i) in vueDateRange.dates">
                        <v-card flat tile>
                            <input type="hidden" :name="`dates[${i}]`" :value="date.value">
                            <v-card-title class="py-1 grey--text">
                                <span v-html="`${date.moment.format('YYYY-MM-DD')}`"></span>
                                <span class="px-2" v-html="`${date.moment.format('ddd')}`"></span>
                                <v-spacer></v-spacer>
                                <v-btn icon @click="remove(vueDateRange.dates, i)"><v-icon>close</v-icon></v-btn>
                            </v-card-title>
                            <v-divider></v-divider>
                        </v-card>
                    </template>
                    <v-card-text>
                        <v-text-field name="start_time" label="{{ __('Start Time') }}"></v-text-field>
                        <v-text-field name="end_time" label="{{ __('End Time') }}"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn class="primary white--text">{{ __('Save') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('timesheet/vue-date-range/vue-date-range.js') }}"></script>
    <script src="{{ assets('timesheet/vue-date-range/moment.min.js') }}"></script>
    <script src="{{ assets('timesheet/mixins/vue-date-range.js?v=ds') }}"></script>
    <script>
        mixins.push(VueDateRange.init({
            lang: 'en',
            range: {
                startDate: moment(),
                endDate: moment(),
            },
            dates: [],
            format: '{{ settings('js_date_format') }}',
        }));
    </script>
@endpush
