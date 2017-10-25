<v-card class="elevation-1">
    <v-card-media class="sortable-handle" src="{{ assets('frontier/images/placeholder/red.jpg') }}">
        <div class="overlay-bg"></div>
        <v-layout column class="media">
            <v-card-title class="pa-0">
                <v-spacer></v-spacer>
                <v-menu bottom left>
                    <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                    <v-list>
                        <v-list-tile @click="" ripple>
                            <v-list-tile-action>
                                <v-icon error class="red--text">remove_circle</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ __('Remove') }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-card-title>
            <v-spacer></v-spacer>
            <v-card-text class="white--text text-xs-center">
                <div class="title pb-3">Assignment</div>
                <div class="display-3 weight-600"> 10 </div>
                <div class="body-2 white--text">Total</div>
                <v-btn round dark outline dark>View All</v-btn>
            </v-card-text>
        </v-layout>
    </v-card-media>

    <v-card-text class="red lighten-2 white--text text-xs-center">
        {{-- <div class="body-2 white--text">Assignments</div> --}}
        <v-layout row wrap>
            <v-flex xs6>
                <div class="title">2</div>
                <div class="caption"> Done </div>
            </v-flex>
            <v-flex xs6>
                <div class="title">8</div>
                <div class="caption">Remaining</div>
            </v-flex>
        </v-layout>
    </v-card-text>
    <v-card-text class="pa-0">
        <v-list three-line class="pa-0">
            <v-list-tile avatar ripple @click="">
                <v-list-tile-content>
                    <v-list-tile-title>Quiz on PS 7</v-list-tile-title>
                    <v-list-tile-sub-title><v-icon class="green--text body-1">schedule</v-icon> Aug 21, 2017</v-list-tile-sub-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn icon ripple v-tooltip:left="{ html: 'Download' }">
                        <v-icon class="grey--text text--lighten-1">file_download</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list-tile avatar ripple @click="">
                <v-list-tile-content>
                    <v-list-tile-title>Assessment</v-list-tile-title>
                    <v-list-tile-sub-title><v-icon class="green--text body-1">schedule</v-icon> Aug 20, 2017</v-list-tile-sub-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn icon ripple v-tooltip:left="{ html: 'Download' }">
                        <v-icon class="grey--text text--lighten-1">file_download</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-card-text>
</v-card>

@push('css')
    <style>
        .overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(86, 39, 39, 0.64);
            /*background: rgba(204, 96, 96, 0.64);*/
            z-index: 0;
        }
        .media .card__text {
            z-index: 1;
        }
        .weight-600 {
            font-weight: 600 !important;
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
                    items: []
                }
            }
        })
    </script>
@endpush
