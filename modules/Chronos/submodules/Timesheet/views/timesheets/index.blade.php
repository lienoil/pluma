@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid>
        <v-layout row wrap fill-height>
            <v-flex sm3 fill-height>
                <v-spacer></v-spacer>
                <v-date-picker class="elevation-1" no-title v-model="calendar.model" actions></v-date-picker>
                <v-spacer></v-spacer>
            </v-flex>
            <v-flex sm9>
                <form action="{{ route('timesheets.store') }}" method="POST">
                    {{ csrf_field() }}

                    <v-card class="elevation-1">
                        <v-toolbar card>
                            <v-toolbar-title>{{ __('New Timesheet') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-subheader>{{ __('Time Range') }}</v-subheader>
                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.in"
                                label="{{ _('Time in') }}"
                                name="time_in"
                                value="{{ old('in') }}"
                                @input="(val) => { resource.item.in = val; }"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.out"
                                label="{{ _('Time out') }}"
                                name="time_out"
                                value="{{ old('out') }}"
                                @input="(val) => { resource.item.out = val; }"
                            ></v-text-field>
                        </v-card-text>

                        <v-subheader>{{ __('Date Range') }}</v-subheader>
                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.from_date"
                                label="{{ _('From Date') }}"
                                name="from_date"
                                value="{{ old('from_date') }}"
                                @input="(val) => { resource.item.from_date = val; }"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.to_date"
                                label="{{ _('To Date') }}"
                                name="to_date"
                                value="{{ old('to_date') }}"
                                @input="(val) => { resource.item.to_date = val; }"
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn type="submit">{{ __('Save') }}</v-btn>
                        </v-card-actions>
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
                    calendar: {
                        model: '',
                    },
                    resource: {
                        item: {
                            in: '',
                            out: '',
                        },
                        items: [],
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    }
                };
            }
        })
    </script>
@endpush
