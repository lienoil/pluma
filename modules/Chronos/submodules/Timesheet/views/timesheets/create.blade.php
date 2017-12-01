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
                        </v-toolbar>
                        <v-card-text>
                            <input type="hidden" name="user_id" value="{{ user()->id }}">
                            <v-text-field
                                label="{{ __('Name') }}"
                                name="name"
                                :error-messages="vueDateRange.resource.errors.name"
                                :value="`{{ old('name') ? old('name') : __(v('vueDateRange.range.startDate.format("MMMM YYYY")', true) . ' Time Sheet') }}`"
                            ></v-text-field>

                            <template>
                                {{-- Code --}}
                                <v-text-field
                                    label="{{ __('Month-Year Code') }}"
                                    prepend-icon="lock"
                                    name="code"
                                    :error-messages="vueDateRange.resource.errors.code"
                                    :value="`{{ old('code') ? old('code') : __(v('vueDateRange.range.startDate.format("MM-YYYY")', true)) }}`"
                                    persistent-hint
                                    hint="{{ __('You will not be able to edit this field') }}"
                                    readonly
                                ></v-text-field>
                            </template>
                        </v-card-text>
                        <v-card-text>
                            <v-text-field
                                label="{{ __('Dates') }}"
                                :error-messages="vueDateRange.resource.errors.dates"
                                prepend-icon="date_range"
                                persistent-hint
                                hint="{{ __('Click to display all dates') }}"
                                append-icon="keyboard_arrow_down"
                                :append-icon-cb="() => (vueDateRange.revealDates = !vueDateRange.revealDates)"
                                @click="vueDateRange.revealDates = !vueDateRange.revealDates"
                                :value="`from ${vueDateRange.startDate?vueDateRange.startDate.format('MMM Do'):''} to ${vueDateRange.endDate?vueDateRange.endDate.format('MMM Do YYYY'):''}`"
                                readonly
                            ></v-text-field>
                        </v-card-text>
                        <v-slide-y-transition>
                            <div v-show="vueDateRange.revealDates">
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn flat class="error error--text" ripple @click="removeSundays(vueDateRange.dates)">{{ __('Remove Sundays') }}</v-btn>
                                </v-card-actions>
                                <v-list class="pa-0" dense>
                                    <template v-for="(date, i) in vueDateRange.dates">
                                        <v-list-tile>
                                            <v-list-tile-avatar>
                                                <v-icon>fa-calendar-o</v-icon>
                                            </v-list-tile-avatar>
                                            <v-list-tile-content>
                                                <input type="hidden" :name="`dates[${i}][date]`" :value="date.value">
                                                <input type="hidden" :name="`dates[${i}][time_in]`" :value="vueDateRange.time.start">
                                                <input type="hidden" :name="`dates[${i}][time_out]`" :value="vueDateRange.time.end">
                                                <v-chip label class="white--text px-2" :class="{'green accent-4': date.moment.format('d') != 0 && date.moment.format('d') != 6, 'error lighten-2': date.moment.format('d') == 0, 'blue lighten-2': date.moment.format('d') == 6}" v-html="`${date.moment.format('YYYY-MM-DD')} | ${date.moment.format('dddd')}`"></v-chip>
                                            </v-list-tile-content>
                                            <v-list-tile-action>
                                                <v-btn icon @click="remove(vueDateRange.dates, i)"><v-icon>close</v-icon></v-btn>
                                            </v-list-tile-action>
                                        </v-list-tile>
                                        <v-divider></v-divider>
                                    </template>
                                </v-list>
                            </div>
                        </v-slide-y-transition>

                        <v-card-text>
                            <template>
                                {{-- Time in --}}
                                <v-menu
                                    :close-on-content-click="false"
                                    transition="slide-y-transition"
                                    offset-y
                                    full-width
                                    :nudge-right="40"
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <div slot="activator">
                                        <v-text-field
                                            {{-- slot="activator" --}}
                                            label="{{ __('Time in') }}"
                                            name="start_time"
                                            v-model="vueDateRange.time.start"
                                            :error-messages="vueDateRange.resource.errors.time_in"
                                            prepend-icon="access_time"
                                            persistent-hint
                                            :hint="vueDateRange.time.start"
                                            :value="vueDateRange.time.start"
                                            readonly
                                        ></v-text-field>
                                    </div>
                                    <v-time-picker format="ampm" actions scrollable v-model.sync="vueDateRange.time.start">
                                        <template scope="{ save, cancel }">
                                            <v-card-actions>
                                                <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                                <v-btn flat primary @click.native="save()">Save</v-btn>
                                            </v-card-actions>
                                        </template>
                                    </v-time-picker>
                                </v-menu>
                                <input type="hidden" name="time_in" :value="vueDateRange.time.start">
                            </template>

                            <template>
                                {{-- Time out --}}
                                <v-menu
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
                                        {{-- v-model="vueDateRange.time.end" --}}
                                        prepend-icon="timelapse"
                                        :error-messages="vueDateRange.resource.errors.time_out"
                                        persistent-hint
                                        :hint="vueDateRange.time.end"
                                        :value="vueDateRange.time.end"
                                        {{-- readonly --}}
                                    ></v-text-field>
                                    <v-time-picker format="ampm" actions scrollable v-model="vueDateRange.time.end">
                                        <template scope="{ save, cancel }">
                                            <v-card-actions>
                                                <v-btn flat primary @click.native="cancel">Cancel</v-btn>
                                                <v-btn flat primary @click.native="save">Save</v-btn>
                                            </v-card-actions>
                                        </template>
                                    </v-time-picker>
                                </v-menu>
                                <input type="hidden" name="time_out" :value="vueDateRange.time.end">
                            </template>

                            <template>
                                {{-- Category --}}
                                <v-menu
                                    transition="slide-y-transition"
                                    offset-y
                                    full-width
                                    max-width="290px"
                                    min-width="290px"
                                >
                                    <v-text-field
                                        {{-- hide-details --}}
                                        slot="activator"
                                        prepend-icon="label"
                                        label="{{ __('Category') }}"
                                        v-model="vueDateRange.resource.category.name"
                                        :error-messages="vueDateRange.resource.errors.name"
                                        @input="(val) => {vueDateRange.resource.category.id = null}"
                                    ></v-text-field>
                                    <v-card>
                                        <v-card-actions>
                                            <span class="caption grey--text">{{ __('Suggestions') }}</span>
                                        </v-card-actions>
                                        <v-list>
                                            <template v-for="(name,id) in vueDateRange.categories">
                                                <v-list-tile @click="vueDateRange.resource.category = {name, id}">
                                                    <v-list-tile-content>
                                                        <v-list-tile-title v-html="name"></v-list-tile-title>
                                                    </v-list-tile-content>
                                                </v-list-tile>
                                            </template>
                                        </v-list>
                                    </v-card>
                                </v-menu>
                                <input type="hidden" name="category_name" :value="vueDateRange.resource.category.name">
                                <input type="hidden" name="category_id" :value="vueDateRange.resource.category.id">
                            </template>

                            <template>
                                {{-- Work --}}
                                <v-text-field
                                    label="{{ __('Work') }}"
                                    name="work"
                                    prepend-icon="work"
                                    placeholder="{{ __('e.g. compiled reports, reviewed document, shredded evidence...') }}"
                                    :error-messages="vueDateRange.resource.errors.work"
                                ></v-text-field>
                            </template>
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
    <script src="{{ assets('timesheet/mixins/vue-date-range.js?v=13s') }}"></script>
    <script>
        mixins.push(VueDateRange.init({
            lang: '{{ settings('site_language') }}',
            range: {
                startDate: moment(),
                endDate: moment(),
            },
            disableStart: moment(),
            disableEnd: moment(),
            dates: {!! json_encode(old('dates')) !!} ? {!! json_encode(old('dates')) !!} : [],
            format: '{{ settings('js_date_format') }}',
            time: {
                start: null,
                end: null,
            },
            resource: {
                category: {name:'', id:''},
                errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
            },
            revealDates: true,
            categories: {!! json_encode($categories->toArray()) !!},
        }));
    </script>
@endpush
