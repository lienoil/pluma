@viewable('badge')

    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card v-show="!removebadge" transition="slide-y-transition" class="elevation-1 mb-3 draggable-widget">
                <v-toolbar flat class="transparent sortable-handle">
                    <v-toolbar-title class="page-title subheading">{{ __('Badge') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu bottom left>
                        <v-btn icon slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                        <v-list>
                            <v-list-title @click="removebadge = !removebadge"
                                ripple
                                v-bind:ripple="{ class: 'indigo--text text--darken-2' }">
                                <v-list-title-action>
                                    <v-icon error class="error--text">remove_circle</v-icon>
                                </v-list-title-action>
                                <v-list-title-content>
                                    <v-list-tile-title>
                                        {{ __('Remove') }}
                                    </v-list-tile-title>
                                </v-list-title-content>
                            </v-list-title>
                            <v-list-title @click="setStorage('widget.hidebadge', (hidebadge = !hidebadge))"
                                ripple
                                v-bind:ripple="{ class: 'indigo--text text--darken-2' }">
                                <v-list-title-action>
                                    <v-icon error class="error--text">remove_circle</v-icon>
                                </v-list-title-action>
                                <v-list-title-content>
                                    <v-list-title-title>
                                        {{ __('Remove') }}
                                    </v-list-title-title>
                                </v-list-title-content>
                            </v-list-title>
                            <v-list-title @click="setStorage('widget.hidebadge', (hidebadge = !hidebadge))"
                                ripple
                                v-bind:ripple="{ class: 'indigo--text text--darken-2' }">
                                <v-list-title-action>
                                    <v-icon class="grey--text">@{{ hidebadge ? 'visibility' : 'visibility_off' }}</v-icon>
                                </v-list-title-action>
                                <v-list-title-content>
                                    <v-list-title-title>
                                        @{{ hidebadge ? 'Show' : 'Hide' }}
                                    </v-list-title-title>
                                </v-list-title-content>
                            </v-list-title>
                        </v-list>
                    </v-menu>
                </v-toolbar>

                <v-divider></v-divider>

                {{-- content --}}

                <v-card-text class="pa-5 text-xs-center grey--text text--darken-1 grey lighten-3">
                    <v-icon class="display-1 grey--text text--darken-1 mb-3">stars</v-icon>
                    <div label class="body-1">
                        {!! __('No badges<br>to show.') !!}
                    </div>
                </v-card-text>
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removebadge: this.getStorage('widgets.removebadge') === "true",
                        hidebadge: this.getStorage('widgets.hidebadge') === "true",
                    }
                }
            });
        </script>
    @endpush
@endviewable
