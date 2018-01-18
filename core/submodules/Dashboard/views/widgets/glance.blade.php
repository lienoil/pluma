@viewable(widgets('glance'))
    <v-card class="elevation-1">
        <v-card-media src="{{ widgets()->glance->backdrop }}">
            <div class="insert-overlay"
                style="background: rgba(9, 53, 74, 0.3); position: absolute; width: 100%; height: 100%;"></div>
            <v-toolbar class="transparent elevation-0">

                <v-select class="white--text" light :items="year" item-text="title" label="{{ __("Filter") }}" overflow></v-select>

                <v-menu
                    transition="slide-y-transition"
                    bottom
                    dark
                    >
                    <v-btn round  slot="activator" flat class="white--text">
                        <span>{{ __("Daily") }}</span><v-icon class="white--text" right>arrow_drop_down</v-icon>
                    </v-btn>
                    <v-list>
                        <v-list-tile v-for="(item, i) in year" :key="i" @click>
                            <v-list-tile-title>@{{ item.title }}</v-list-tile-title>
                        </v-list-tile>
                    </v-list>
                </v-menu>
                <v-spacer></v-spacer>
                <v-btn icon v-tooltip:left="{html: 'Download'}" dark class="mr-4">
                    <v-icon>file_download</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text class="pa-5">
                <v-layout row wrap class="media" justify-center align-center>
                    <v-flex sm4 xs12 class="text-xs-center">
                        <v-layout row wrap>
                            <v-flex xs6>
                                <v-layout row wrap class="media">
                                    <v-card-text class="white--text">
                                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon>103</div>
                                        <div class="caption"> New Students</div>
                                    </v-card-text>
                                </v-layout>
                            </v-flex>
                            <v-flex xs6>
                                <v-layout row wrap class="media">
                                    <v-card-text class="white--text">
                                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon>124</div>
                                        <div class="caption"> New Courses</div>
                                    </v-card-text>
                                </v-layout>
                            </v-flex>
                        </v-layout>

                        <v-layout row wrap>
                            <v-flex xs6>
                                <v-layout row wrap class="media">
                                    <v-card-text class="white--text">
                                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon> 567</div>
                                        <div class="caption"> Total Students</div>
                                    </v-card-text>
                                </v-layout>
                            </v-flex>
                            <v-flex xs6>
                                <v-layout row wrap class="media">
                                    <v-card-text class="white--text">
                                        <div class="headline"><v-icon dark class="green--text">arrow_drop_up</v-icon> 566</div>
                                        <div class="caption"> Total Courses</div>
                                    </v-card-text>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex sm4 xs12>
                        <v-layout row wrap class="media">
                            <v-card-text class="body-2 cyan--text text--lighten-3 pa-3 text-xs-center">Individual Progress vs Overall Progress</v-card-text>
                            <v-card-text>
                                <div class="white--text body-1">Course X</div>
                                <v-progress-linear value="35" color-front="cyan" color-back="accent lighten-4" background-opacity="3" height="10"></v-progress-linear>

                                <div class="white--text body-1">Course Y</div>
                                <v-progress-linear value="35" color-front="cyan" color-back="accent lighten-4" height="10"></v-progress-linear>

                            </v-card-text>
                        </v-layout>
                    </v-flex>

                    <v-flex sm4 xs12 class="text-xs-center">
                        <v-layout row wrap class="media">
                            <v-card-text class="body-2 cyan--text text--lighten-3">Comparison of Classes</v-card-text>
                        </v-layout>
                        <v-layout row wrap>
                                <v-flex sm6 xs12>
                                    <v-progress-circular
                                        v-bind:size="100"
                                        v-bind:width="10"
                                        v-bind:value="value"
                                        class="cyan--text text--lighten-1"
                                        >
                                        @{{ value }}
                                    </v-progress-circular>
                                    <v-layout row wrap class="media">
                                        <v-card-text class="pa-0">
                                            <div class="caption white--text">50%</div>
                                        </v-card-text>
                                    </v-layout>
                                </v-flex>
                                <v-flex sm6 xs12>
                                    <v-progress-circular
                                        v-bind:size="100"
                                        v-bind:width="10"
                                        v-bind:value="value"
                                        class="cyan--text text--lighten-1"
                                        >
                                        @{{ value }}
                                    </v-progress-circular>
                                    <v-layout row wrap class="media">
                                        <v-card-text class="pa-0">
                                            <div class="caption white--text">50%</div>
                                        </v-card-text>
                                    </v-layout>
                                </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-card-text>
        </v-card-media>
    </v-card>
    <v-card class="elevation-1">
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
    </v-card>
@endviewable

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    year: [
                        { title: 'Daily' },
                        { title: 'Weekly' },
                        { title: 'Monthly' },
                        { title: 'Yearly' }
                    ],
                    interval: {},
                    value: 30,
                    rotate: 30,
                }
            },
            beforeDestroy () {
                clearInterval(this.interval)
            },
        })
    </script>
@endpush

