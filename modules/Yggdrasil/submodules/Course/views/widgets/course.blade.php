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
                <v-card-media v-show="!hidecourse" src="{{ assets('frontier/images/placeholder/gradient.png') }}" height="100%">
                    <v-card-text>
                        <div class="text-xs-center mb-4">
                            <v-avatar class="mb-3" size="80px">
                                <img src="{{ assets('frontier/images/placeholder/girl.png') }}" alt="">
                            </v-avatar>
                            <p class="body-1 white--text page-title mb-1">Solve Problems and Make Decisions at Supervisory Level</p>
                        </div>
                    </v-card-text>
                </v-card-media>
                <v-card-text>
                    <p class="body-2 page-title mb-1"><strong>Performance Statement 1:</strong></p>
                    <h2 class="body-2 page-title"><strong>Introduction</strong></h2>
                    <p class="body-1">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum odio labore placeat fuga obcaecati delectus impedit quam dolores minima autem ut cum, eos, tempora esse quod. Deserunt porro, magnam soluta.
                    </p>
                </v-card-text>
                <v-card-actions class="px-3">
                    <v-spacer></v-spacer>
                    <v-btn flat primary>Continue</v-btn>
                </v-card-actions>
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
