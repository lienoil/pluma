<v-card class="elevation-1">
    <v-card-media class="sortable-handle" src="{{ assets('frontier/images/placeholder/9.png') }}">
        {{-- <div class="insert-overlay" style="background: rgba(102, 78, 144, 0.54); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.54); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
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
                <div class="title pb-3">Announcement</div>
                <div class="display-3 weight-600"> 8 </div>
                <div class="body-2 white--text">Total</div>
                <v-btn round dark outline dark href="\admin/announcements">View All</v-btn>
            </v-card-text>
        </v-layout>
    </v-card-media>
    <v-card-text class="pa-0">
        <v-list three-line class="pa-0">
            <v-card-text>
                <v-card class="elevation-2 border-left mb-3">
                    <v-list-tile avatar ripple  @click="">
                        <v-list-tile-content>
                            <v-list-tile-title>No Classes on 01 September 2017 - Eid Al-Adha</v-list-tile-title>
                            <v-list-tile-sub-title>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur laboriosam et ad non maiores autem reprehenderit soluta, voluptatum, natus praesentium adipisci neque culpa nostrum unde exercitationem aperiam fuga eos.</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-card>
                <v-card class="elevation-2 border-left">
                    <v-list-tile avatar ripple  @click="">
                        <v-list-tile-content>
                            <v-list-tile-title>No Classes on 26 June 2017 - Hari Raya</v-list-tile-title>
                            <v-list-tile-sub-title>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel eveniet deleniti, sed alias modi in aliquam quam sequi ut neque laudantium, laborum earum, debitis accusantium. Tenetur voluptates officia beatae voluptas.</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-card>

                {{-- search --}}
            </v-card-text>
        </v-list>
    </v-card-text>
</v-card>

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
        .border-left {
            border-left: 4px solid #ba68c8;
        }
        .list--three-line .list__tile__sub-title {
            -webkit-box-orient: vertical;
        }
    </style>
@endpush
