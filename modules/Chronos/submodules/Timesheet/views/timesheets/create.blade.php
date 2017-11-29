@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex md5>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title primary-title class="subheading">{{ __('Calendar') }}</v-toolbar-title>
                    </v-toolbar>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <daterange
                            :emit-change-on-step0="true"
                            :first-day-of-week="{{ settings('first_day_of_the_week', 1) }}"
                            :lang="vueDateRange.lang"
                            class="calendar"
                            month-year-format="MMMM YYYY"
                            v-model="vueDateRange.range"
                            @change="onVueDateRangeChange"
                        ></daterange>

                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex sm7>
                <form action="{{ route('timesheets.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title primary-title class="subheading">{{ __('New Timesheet') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn flat class="error error--text" ripple @click="removeSundays(vueDateRange.dates)">{{ __('Remove Sundays') }}</v-btn>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field
                                label="{{ __('Name') }}"
                                name="name"
                                :error-messages="vueDateRange.resource.errors.name"
                                :value="`{{ old('name') ? old('name') : __(v('vueDateRange.range.startDate.format("MMMM")', true) . ' Time Sheet') }}`"
                            ></v-text-field>

                            <p class="subheading grey--text">{{ __('Dates ') }}<em v-html="`from ${vueDateRange.range.startDate.format('MMMM Do')} to ${vueDateRange.range.endDate.format('MMMM Do')} ${vueDateRange.range.endDate.format('YYYY')}`"></em></p>
                            <p v-if="vueDateRange.resource.errors.dates" class="caption error--text" v-html="vueDateRange.resource.errors.dates.join(',')"></p>
                        </v-card-text>
                        <template v-for="(date, i) in vueDateRange.dates">
                            <v-card flat tile>
                                <input type="hidden" :name="`dates[${i}][date]`" :value="date.value">
                                <input type="hidden" :name="`dates[${i}][time_start]`" :value="vueDateRange.time.start">
                                <input type="hidden" :name="`dates[${i}][time_end]`" :value="vueDateRange.time.end">
                                <v-card-title class="py-1 grey--text">
                                    <v-chip label class="white--text px-2" :class="{'green accent-4': date.moment.format('d') != 0 && date.moment.format('d') != 6, 'error lighten-2': date.moment.format('d') == 0, 'blue lighten-2': date.moment.format('d') == 6}" v-html="`${date.moment.format('YYYY-MM-DD')} | ${date.moment.format('dddd')}`"></v-chip>
                                    <v-spacer></v-spacer>
                                    <v-btn icon @click="remove(vueDateRange.dates, i)"><v-icon>close</v-icon></v-btn>
                                </v-card-title>
                                <v-divider></v-divider>
                            </v-card>
                        </template>
                        <v-card-text>
                            <v-menu
                                lazy
                                :close-on-content-click="false"
                                transition="slide-y-transition"
                                offset-y
                                full-width
                                :nudge-right="40"
                                max-width="290px"
                                min-width="290px"
                            >
                                <v-text-field
                                    slot="activator"
                                    label="{{ __('Time in') }}"
                                    name="start_time"
                                    v-model="vueDateRange.time.start"
                                    :error-messages="vueDateRange.resource.errors.time_start"
                                    prepend-icon="access_time"
                                    readonly
                                ></v-text-field>
                                <v-time-picker actions scrollable v-model="vueDateRange.time.start">
                                    <template scope="{ save, cancel }">
                                        <v-card-actions>
                                            <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                            <v-btn flat primary @click.native="save()">Save</v-btn>
                                        </v-card-actions>
                                    </template>
                                </v-time-picker>
                            </v-menu>
                            <v-menu
                                lazy
                                :close-on-content-click="false"
                                transition="slide-y-transition"
                                offset-y
                                full-width
                                :nudge-right="40"
                                max-width="290px"
                                min-width="290px"
                            >
                                <v-text-field
                                    slot="activator"
                                    label="{{ __('Time out') }}"
                                    name="end_time"
                                    v-model="vueDateRange.time.end"
                                    prepend-icon="timelapse"
                                    :error-messages="vueDateRange.resource.errors.time_end"
                                    readonly
                                ></v-text-field>
                                <v-time-picker actions scrollable v-model="vueDateRange.time.end">
                                    <template scope="{ save, cancel }">
                                        <v-card-actions>
                                            <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                            <v-btn flat primary @click.native="save()">Save</v-btn>
                                        </v-card-actions>
                                    </template>
                                </v-time-picker>
                            </v-menu>
                            <input type="hidden" name="time_start" :value="vueDateRange.time.start">
                            <input type="hidden" name="time_end" :value="vueDateRange.time.end">
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" class="primary white--text">{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('timesheet/vue-date-range/vue-date-range.js') }}"></script>
    <script src="{{ assets('timesheet/vue-date-range/moment.min.js') }}"></script>
    <script src="{{ assets('timesheet/mixins/vue-date-range.js?v=12UssuOssP') }}"></script>
    <script>
        mixins.push(VueDateRange.init({
            lang: '{{ settings('site_language') }}',
            range: {
                startDate: moment(),
                endDate: moment(),
            },
            disableStart: moment(),
            disableEnd: moment(),
            dates: [],
            format: '{{ settings('js_date_format') }}',
            time: {
                start: null,
                end: null,
            },
            resource: {
                errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
            }
        }));
    </script>
@endpush
