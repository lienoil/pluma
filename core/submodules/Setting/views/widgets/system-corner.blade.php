@viewable(widgets('system-corner'))
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card v-show="!removesystemcorner" transition="slide-y-transition" dark class="elevation-1 mb-3 grey darken-4 draggable-widget">
                <v-toolbar dark card class="transparent sortable-handle">
                    <v-icon dark>{{ widgets('system-corner')->icon }}</v-icon>
                    <v-toolbar-title class="body-2">{{ widgets('system-corner')->name }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu bottom left>
                        <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                       <v-list>
                            <v-list-tile @click="removesystemcorner = !removesystemcorner" ripple>
                                <v-list-tile-action>
                                    <v-icon error class="error--text">remove_circle</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ __('Remove') }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile @click="setStorage('widgets.hidesystemcorner', (hidesystemcorner = !hidesystemcorner))" ripple>
                                <v-list-tile-action>
                                    <v-icon class="grey--text">@{{ hidesystemcorner ? 'visibility' : 'visibility_off' }}</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        @{{ hidesystemcorner ? 'Show' : 'Hide' }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </v-toolbar>
                <v-card-text v-show="!hidesystemcorner" class="grey darken-3">
                    <v-subheader class="white--text">{{ __('Server Environment') }}</v-subheader>

                    <div class="white--text body-1 pa-3">
                        <div class="grey--text body-2">{{ __('Server Software') }}</div>
                        <div>{{ $_SERVER['SERVER_SOFTWARE'] }}</div>
                    </div>

                    <div class="white--text body-1 pa-3">
                        <div class="grey--text body-2">{{ __('Server Admin') }}</div>
                        <div>{{ $_SERVER['SERVER_ADMIN'] }}</div>
                    </div>

                    <div class="white--text body-1 pa-3">
                        <div class="grey--text body-2">{{ __('Document Root') }}</div>
                        <div>{{ $_SERVER['DOCUMENT_ROOT'] }}</div>
                    </div>

                    <div class="white--text body-1 pa-3">
                        <div class="grey--text body-2">{{ __('Remote Address') }}</div>
                        <div>{{ $_SERVER['REMOTE_ADDR'] }}</div>
                    </div>

                    <div class="white--text body-1 pa-3">
                        <div class="grey--text body-2">{{ __('Server Signature') }}</div>
                        <div>{!! $_SERVER['SERVER_SIGNATURE'] !!}</div>
                    </div>

                </v-card-text>
                <v-card-actions v-show="!hidesystemcorner">
                    <v-spacer></v-spacer>
                    <v-btn flat dark href="{{ route('settings.system') }}">{{ __('View More') }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removesystemcorner: this.getStorage('widgets.removesystemcorner') === "true",
                        hidesystemcorner: this.getStorage('widgets.hidesystemcorner') === "true",
                    }
                }
            });
        </script>
    @endpush
@endviewable
