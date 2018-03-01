@viewable('course')
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card v-show="!removecourse" transition="slide-y-transition" class="elevation-1 mb-3 draggable-widget">
                <v-toolbar flat class="transparent sortable-handle">
                    <v-toolbar-title class="page-title subheading">Continue Course</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu bottom left>
                        <v-btn icon slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                       <v-list>
                            <v-list-tile @click="removecourse = !removecourse" ripple>
                                <v-list-tile-action>
                                    <v-icon error class="error--text">remove_circle</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ __('Remove') }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile @click="setStorage('widget.hidecourse', (hidecourse = !hidecourse))" ripple>
                                <v-list-tile-action>
                                    <v-icon class="grey--text">@{{ hidecourse ? 'visibility' : 'visibility_off' }}</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        @{{ hidecourse ? 'Show' : 'Hide' }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </v-toolbar>

                <v-divider></v-divider>
                {{-- list of courses --}}
                <v-list two-line subheader v-show="!hidecourse">
                    <v-subheader>Folders</v-subheader>
                    <v-list-tile avatar @click="" ripple>
                        <v-list-tile-avatar>
                            <img src="{{ assets('frontier/images/placeholder/girl.png') }}" alt="">
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ __('Performance Statement 1: Introduction') }}</v-list-tile-title>
                            <v-list-tile-sub-title>{{ __('Solve Problems and Make Decisions at Supervisory Level') }}</v-list-tile-sub-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-btn icon ripple v-tooltip:left="{ html: 'Details' }">
                                <v-icon class="grey--text text--lighten-1">info</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-divider inset></v-divider>
                    <v-list-tile avatar @click="" ripple>
                        <v-list-tile-avatar>
                            <img src="{{ assets('frontier/images/placeholder/girl.png') }}" alt="">
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ __('Performance Statement 3: Animation') }}</v-list-tile-title>
                            <v-list-tile-sub-title>{{ __('Develop Personal Effectiveness at Supervisory Level') }}</v-list-tile-sub-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-btn icon ripple v-tooltip:left="{ html: 'Details' }">
                                <v-icon class="grey--text text--lighten-1">info</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
                {{-- /list of courses --}}
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('css')
        <style>

        </style>
    @endpush

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removecourse: this.getStorage('widgets.removecourse') === "true",
                        hidecourse: this.getStorage('widgets.hidecourse') === "true",
                    }
                }
            });
        </script>
    @endpush
@endviewable
