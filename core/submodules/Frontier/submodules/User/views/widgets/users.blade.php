@viewable('user-count')
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
        >
        <v-slide-y-transition>
            <v-card
                class="draggable-widget white--text elevation-1 mb-3"
                v-show="!removebar_st"
                transition="slide-y-transition"
                style="background: #fff;">
                <v-toolbar light class="transparent elevation-0 sortable-handle">
                    <v-toolbar-title class="subheading w--500">Courses with Minimal Activity</v-toolbar-title>
                    <v-spacer></v-spacer>

                    <v-menu bottom left>
                        <v-btn icon slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                        <v-list>
                            <v-list-tile @click="removebar_st = !removebar_st" ripple>
                                <v-list-tile-action>
                                    <v-icon error class="error--text">remove_circle</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ __('Remove') }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile @click="hidebar_st = !hidebar_st" ripple>
                                <v-list-tile-action>
                                    <v-icon class="grey--text">@{{ hidebar_st ? 'visibility' : 'visibility_off' }}</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        @{{ hidebar_st ? 'Show' : 'Hide' }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </v-toolbar>

                <v-slide-y-transition>
                    <v-card-text v-show="!hidebar_st">
                        <v-card dark flat class="transparent text-xs-center">
                            <v-card-text class="pt-0 pb-5 light-blue--text text--darken-3">
                                <div class="body-2">PSDM OPS,
                                    <span class="caption light-blue--text text--lighten-1"><em>88%</em></span>
                                </div>
                            </v-card-text>
                        </v-card>
                        <div class="mini-chart-container">
                            <canvas id="bar_st"></canvas>
                        </div>
                    </v-card-text>
                </v-slide-y-transition>
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('css')
        <style>
            .mini-chart-container {
                position: relative;
                height: 100px;
            }
        </style>
    @endpush

    @push('pre-scripts')
        <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
        <script>
            Vue.use(VueResource);

            mixins.push({
                data () {
                    return {
                        hidebar_st: false,
                        removebar_st: false,
                    }
                }
            })
        </script>
    @endpush


    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
        <script>

            var ctx = document.getElementById('bar_st').getContext('2d');
            var gradient = ctx.createLinearGradient(0, 0, 0, 100);
            gradient.addColorStop(0.25, 'rgba(3, 150, 243, .9)');
            gradient.addColorStop(0.5, 'rgba(3, 150, 243, .9)');
            gradient.addColorStop(1, 'rgba(3, 150, 243, .9)');

            Chart.defaults.global.defaultFontColor = '#fff';
            var chart = new Chart(ctx, {
                type: 'bar',

                data: {
                    labels: ["DPE SUP", "PSDM OPS", "PSDM SUP", "DPE OPS", "FECE SUP", "FEWT SUP", "MPPE OPS", "CREW OPS"],
                    datasets: [{
                        label: "Courses with Minimal Activity",
                        backgroundColor: gradient,
                        borderColor: "rgb(3, 150, 243)",
                        borderWidth: 2,
                        hoverBackgroundColor: "rgba(63, 150, 243, 1)",
                        hoverBorderColor: "rgba(63, 150, 243, 1)",
                        data: [20, 88, 58, 73, 18, 58, 73, 18],
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false,
                                color: "rgba(255,99,132,0.2)"
                            },
                            ticks: {
                                display: false
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                display: false
                            }
                        }]
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutCubic'
                    },
                    legend: {
                        display: false,
                        labels: {
                            fontColor: 'rgb(255, 99, 132)'
                        }
                    }
                }
            });
        </script>
    @endpush
@endviewable
