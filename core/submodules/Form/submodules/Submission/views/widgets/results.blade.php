<v-card class="elevation-0 transparent">
    <v-toolbar class="transparent elevation-0">
        <v-menu
            transition="slide-y-transition"
            bottom
            dark
            >
            <v-btn slot="activator" flat class="accent--text">
                Monthly <v-icon>arrow_drop_down</v-icon>
            </v-btn>
            <v-list>
                <v-list-tile v-for="item in year" :key="item.title" @click="">
                    <v-list-tile-title>@{{ item.title }}</v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-menu>
        <v-spacer></v-spacer>
        <v-btn icon v-tooltip:left="{html: 'Download'}" class="mr-4">
            <v-icon>file_download</v-icon>
        </v-btn>
        <v-btn icon @click="p1 = !p1" v-tooltip:left="{ 'html':  p1 ? 'Show Analytics' : 'Hide Analytics' }">
            <v-icon>@{{ p1 ? 'add' : 'remove' }}</v-icon>
        </v-btn>
    </v-toolbar>
    <v-slide-y-transition>
        <v-card class="elevation-0 transparent" v-show="!p1" transition="slide-y-transition">
            <v-card-text>
                <v-container fluid grid-list-lg>
                    <v-layout row wrap justify-center align-center>
                        <v-flex md8 xs12>
                            <div class="chart-container">
                                <canvas id="perf-bar"></canvas>
                            </div>
                        </v-flex>
                        <v-flex md4 xs12>
                            <v-layout row wrap justify-center align-center>
                                <v-card-text class="pa-0 text-xs-center">
                                    <div class="accent--text body-2">Top 3 Most Courses Enrolled</div>
                                </v-card-text>
                                <v-flex xs12>
                                    @include("Submission::widgets.donut")
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
        </v-card>
    </v-slide-y-transition>
</v-card>

@push('css')
    <style>
        .chart-container {
            position: relative;
            height: 200px;
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
                    p1: false,
                    year: [
                        { title: 'Quarterly' },
                        { title: 'Monthly' },
                        { title: 'Yearly' }
                    ],
                }
            }
        })
    </script>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script>
        var ctx = document.getElementById('perf-bar').getContext('2d');
        Chart.defaults.global.defaultFontColor = '#333';
        var chart = new Chart(ctx, {
            type: 'line',
            scaleBeginAtZero : true,
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Total Count of Active Trainers",
                    borderColor: "rgb(0, 188, 212)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(3, 169, 244, .8)",
                    hoverBorderColor: "rgba(3, 169, 244, .8)",
                    data: [65, 59, 30, 81, 56, 75, 25, 79, 20, 61, 66, 15],
                },
                {
                    label: "Total Count of Inactive Trainers",
                    borderColor: "rgb(63, 81, 181)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(3, 169, 244, .8)",
                    hoverBorderColor: "rgba(3, 169, 244, .8)",
                    data: [0, 32, 17, 76, 24, 59, 46, 59, 32, 76, 47, 30],
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
                            display: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            display: true
                        }
                    }]
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutCubic'
                },
                legend: {
                    display: true,
                    labels: {
                        fontColor: '#333'
                    }
                }
            }
        });
    </script>
@endpush
