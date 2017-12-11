<v-slide-y-transition>
    <v-card class="elevation-1 mb-3"
        v-show="!removeannouncement"
        transition="slide-y-transition">
        <v-card-media class="sortable-handle" src="{{ assets('frontier/images/placeholder/9.png') }}">
            {{-- <div class="insert-overlay" style="background: rgba(102, 78, 144, 0.54); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
            <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.54); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
            <v-layout column class="media">
                <v-card-title class="pa-0 subheading white--text">
                    <v-spacer></v-spacer>
                    <v-menu bottom left>
                        <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                       <v-list>
                            <v-list-tile @click="removeannouncement = !removeannouncement" ripple>
                                <v-list-tile-action>
                                    <v-icon error class="error--text">remove_circle</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ __('Remove') }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile @click="hideannouncement = !hideannouncement" ripple>
                                <v-list-tile-action>
                                    <v-icon class="grey--text">@{{ hideannouncement ? 'visibility' : 'visibility_off' }}</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        @{{ hideannouncement ? 'Show' : 'Hide' }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </v-card-title>
                <v-spacer></v-spacer>
                <v-card-text v-show="!hideannouncement" class="white--text text-xs-center">
                    <div class="title pb-3">Announcements</div>
                    <div class="display-2 weight-600"> 8 </div>
                    <div class="body-2 white--text mb-3">Total</div>
                    <v-btn round dark outline dark href="">View All</v-btn>
                </v-card-text>
            </v-layout>
        </v-card-media>
        <v-card-text class="pa-0" v-show="!hideannouncement">
            <v-list three-line class="pa-0">
                <v-list-tile avatar ripple  @click="">
                    <v-list-tile-content>
                        <v-list-tile-title>No Classes on 01 September 2017 - Eid Al-Adha</v-list-tile-title>
                        <v-list-tile-sub-title>Happy holidays to all students!</v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile avatar ripple  @click="">
                    <v-list-tile-content>
                        <v-list-tile-title>No Classes on 26 June 2017 - Hari Raya</v-list-tile-title>
                        <v-list-tile-sub-title>Happy Ramadan to all Muslim Students!</v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-card-text>
    </v-card>
</v-slide-y-transition>

@push('css')
    <style>
        .overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .media .card__text {
            z-index: 1;
        }
        .weight-600 {
            font-weight: 600 !important;
        }
        .list--three-line .list__tile__sub-title {
            -webkit-box-orient: vertical;
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
                    hideannouncement: false,
                    removeannouncement: false,
                }
            }
        })
    </script>
@endpush
