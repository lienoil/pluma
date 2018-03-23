@viewable('glance')

    @if (view()->exists("Theme::widgets.glance-" . user()->roles->first()->code))
        {{-- expr --}}
        @include("Theme::widgets.glance-" . user()->roles->first()->code)
    @else
        @include("Theme::widgets.glance-default")
    @endif

    {{-- <v-card class="elevation-1">
        <v-card-text>
            <v-layout wrap justify-space-around align-center>
                <v-list class="text-xs-center">
                        <v-icon dark class="cyan--text text--darken-1">fa fa-book</v-icon>
                    <div class="mt-2 caption">2 On-going classes</div>
                </v-list>
                <v-list class="text-xs-center">
                        <v-icon dark class="cyan--text text--darken-1">bookmark</v-icon>
                    <div class="mt-2 caption">2 Courses Bookmarked</div>
                </v-list>
                <v-list class="text-xs-center">
                        <v-icon dark class="cyan--text text--darken-1">star</v-icon>
                    <div class="mt-2 caption">2 Badge Earned</div>
                </v-list>
                <v-list class="text-xs-center">
                    <v-icon dark class="cyan--text text--darken-1">bookmark</v-icon>
                    <div class="mt-2 caption">2 Courses Bookmarked</div>
                </v-list>
            </v-layout>
        </v-card-text>
    </v-card> --}}

@endviewable

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    glance: {
                        selections: [
                            { title: 'Daily' },
                            { title: 'Weekly' },
                            { title: 'Monthly' },
                            { title: 'Yearly' }
                        ],
                        selected: 'Daily',
                        hidden: this.getStorage('glance.hidden') === "true" ? true : false,
                    },
                    interval: {},
                    value: 30,
                    rotate: 30,
                }
            },
        })
    </script>
@endpush

