<v-card class="elevation-0">
    <v-toolbar class="elevation-0">
        <v-toolbar-title>{{ __('Statistics') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon v-tooltip:left="{html: 'Export to PDF'}">
            <v-icon>file_download</v-icon>
        </v-btn>
        {{-- <v-btn icon @click="p1 = !p1" v-tooltip:left="{ 'html':  p1 ? 'Show Analytics' : 'Hide Analytics' }">
            <v-icon>@{{ p1 ? 'add' : 'remove' }}</v-icon>
        </v-btn> --}}
    </v-toolbar>
    <v-slide-y-transition>
        <v-card class="elevation-0 transparent" v-show="!p1" transition="slide-y-transition" style="max-height: 70vh; overflow-y: auto;">
            <v-card-text>
                <v-container fluid grid-list-lg>
                    <v-layout row wrap justify-center align-center>
                        <v-flex xs12>
                            <div class="chart-container mb-3">
                                {{-- <span v-for="(charts, i) in chartVariables.items" v-html="i"></span> --}}
                                <canvas :key="i" v-for="(charts, i) in chartVariables.items" :id="`chart-${i}`"></canvas>
                            </div>
                            {{-- @foreach ($resource->fields() as $field) --}}
                                {{-- <div class="fw-500 mb-3"><v-icon class="mr-2 pb-1" style="font-size: 10px;">lens</v-icon> {{ $field->question->label }}</div>
                                 --}}
                                {{-- <div class="pa-3 grey--text text--darken-1" style="padding-left: 21px !important;">{{ $field->answer }}</div> --}}
                            {{-- @endforeach --}}

                        </v-flex>
                        {{-- <v-flex md4 xs12>
                            <v-layout row wrap justify-center align-center>
                                <v-card-text class="pa-0 text-xs-center">
                                    <div class="accent--text body-2">Top 3 Most Courses Enrolled</div>
                                </v-card-text>
                                <v-flex xs12>
                                    @include("Submission::widgets.donut")
                                </v-flex>
                            </v-layout>
                        </v-flex> --}}
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
    {{-- <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script>
        // Vue.use(VueResource);
        mixins.push({
            data () {
                return {
                    p1: false,
                    year: [
                        { title: 'Quarterly' },
                        { title: 'Monthly' },
                        { title: 'Yearly' }
                    ],
                    chartVariables: [],
                }
            },
            methods: {
                getStatistic (query) {
                    let self = this;
                    query = query ? query : {};
                    self.api().post('{{ route('api.submissions.analytic') }}', query).then(data => {
                        self.chartVariables = data;
                        setTimeout(function () {
                            // body...
                        self.displayStatistic(self.chartVariables.items);
                        },100)
                    });
                },
                chartData (_data, _labels, label, id) {
                    var ctx = document.getElementById(id).getContext('2d');
                    var gradient = ctx.createLinearGradient(0, 0, 0, 100);
                    gradient.addColorStop(0.25, 'rgba(236, 64, 122, .8)');
                    gradient.addColorStop(0.5, 'rgba(236, 64, 122, .6)');
                    gradient.addColorStop(1, 'rgba(236, 64, 122, .2)');

                    var gradient_2 = ctx.createLinearGradient(0, 0, 0, 100);
                    gradient_2.addColorStop(0.25, 'rgba(0, 188, 212, .8)');
                    gradient_2.addColorStop(0.5, 'rgba(0, 188, 212, .6)');
                    gradient_2.addColorStop(1, 'rgba(0, 188, 212, .2)');

                    Chart.defaults.global.defaultFontColor = '#333';
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        scaleBeginAtZero : true,
                        data: {
                            labels: _labels,
                            datasets: [{
                                label: label,
                                backgroundColor: gradient_2,
                                borderColor: "rgba(0, 188, 212, 1)", //blue
                                borderWidth: 3,
                                pointRadius: 5,
                                hoverBackgroundColor: "rgba(3, 169, 244, .8)",
                                hoverBorderColor: "rgba(3, 169, 244, .8)",
                                data: _data,
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
                                        display: true,
                                        beginAtZero: true,
                                        padding: 25,
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        display: true,
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
                                    fontColor: '#333',
                                    fontSize: 18,
                                }
                            }
                        }
                    });
                },
                displayStatistic (dataset) {
                    let _dataset = [];
                    for (chart in dataset) {
                        let _labels = [];
                        let _data = [];

                        for (data in dataset[chart].data) {
                            _labels.push(data);
                            _data.push(dataset[chart].data[data]);
                        }

                        console.log(_data, _labels, dataset[chart].label);
                        this.chartData(_data, _labels, dataset[chart].label, "chart-"+chart);
                    }
                }
            },
            mounted () {
                this.getStatistic({form_id: '{{ $id }}'});
            }
        })
    </script>
@endpush
