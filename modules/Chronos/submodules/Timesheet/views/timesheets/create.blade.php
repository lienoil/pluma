@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-flex sm6></v-flex>
        <v-flex md8>
            <v-card class="elevation-1">
                <v-card-title primary-title>{{ __('Test') }}</v-card-title>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-date-picker first-day-of-week="1" scrollable no-title class="elevation-0" v-model="resource.daterange.from"></v-date-picker>
                    <v-spacer></v-spacer>
                    <v-date-picker first-day-of-week="1" scrollable no-title class="elevation-0" v-model="resource.daterange.to"></v-date-picker>
                    <v-spacer></v-spacer>
                </v-card-actions>

                <v-card-text class="grey--text text--darken-2">
                    <p class="headline accent--text">{{ __('From') }} @{{ formatDate(resource.daterange.from) }} {{ __('to') }} @{{ formatDate(resource.daterange.to) }}</p>
                    <input type="hidden" name="daterange" :value="resource.daterange.total">
                    {{-- <v-text-field name="daterange" v-model="resource.daterange.total" label="{{ __('Date Range') }}"></v-text-field> --}}
                </v-card-text>
            </v-card>
        </v-flex>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        daterange: {
                            from: '',
                            to: '',
                        },
                    },
                }
            },

            methods: {
                mResource () {
                    let self = this;

                    return {
                        init () {
                            self.resource = {
                                daterange: {
                                    from: '{{ date('Y-m-d') }}',
                                    to: '{{ date('Y-m-d') }}',
                                },
                            };

                            self.resource.daterange.total = self.resource.daterange.from + '-' + self.resource.daterange.to;
                        }
                    }
                },

                formatDate (date) {
                    return moment(date).format('MMM Do YYYY');
                }
            },

            mounted () {
                this.mResource().init();
            },

            watch: {
                'resource.daterange.from': function (value) {
                    this.resource.daterange.total = this.resource.daterange.from + ' to ' + this.resource.daterange.to;
                },
            }
        })
    </script>
@endpush
