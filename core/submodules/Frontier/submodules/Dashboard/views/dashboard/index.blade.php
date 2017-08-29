@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid>

        <v-layout row wrap v-if="widgets.welcome.show">
            <v-flex>
                <v-card class="elevation-0 mb-4" min-height="200px">
                    <v-card-title class="headline">{{ __('Welcome') }}</v-card-title>
                    <v-card-text>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, eos molestias voluptatum, perferendis reiciendis obcaecati minima ad earum accusantium incidunt suscipit dolore nihil repudiandae tempora doloribus, inventore velit voluptates corporis?</p>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
        <v-layout row wrap>
            <v-flex :class="widgets.calendar.show?'md8':'md12'">
                <v-card class="white elevation-1 mb-4">
                    <v-card-text></v-card-text>
                </v-card>
            </v-flex>
            <v-flex md4 v-if="widgets.calendar.show">
                @include("Frontier::widgets.calendar")
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data: {
                page: {
                    model: true
                },
                widgets: {
                    calendar: {
                        show: false,
                    },
                    welcome: {
                        show: false,
                    },
                }
            },
            mounted () {
                this.initDashboard();
            },
            methods: {
                initDashboard () {
                    this.widgets.welcome.show = this.getStorage('widgets.welcome.show') == 'true';
                    this.widgets.calendar.show = this.getStorage('widgets.calendar.show') == 'true';
                },
            }
        });
    </script>
@endpush

@push('page-settings')
    <v-layout row class="pa-1">
        <v-flex>
            <v-card class="elevation-0">
                <v-card-text>
                    <div class="text-xs-left">
                        <span>{{ __('Widgets') }}</span>
                    </div>
                    <v-switch
                        label="{{ __('Welcome Banner') }}"
                        v-model="widgets.welcome.show"
                        v-on:change="setStorage('widgets.welcome.show', widgets.welcome.show)"
                    ></v-switch>
                    <v-switch
                        label="{{ __('Calendar') }}"
                        v-model="widgets.calendar.show"
                        v-on:change="setStorage('widgets.calendar.show', widgets.calendar.show)"
                    ></v-switch>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
@endpush
