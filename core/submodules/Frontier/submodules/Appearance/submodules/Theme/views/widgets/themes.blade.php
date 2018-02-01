@viewable(widgets('themes'))
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-card tile class="elevation-1 mb-3 draggable-widget">
            <v-card-media class="primary sortable-handle" height="auto" src="{{ get_active_theme()->preview }}">
                <v-layout column wrap flex-end fill-height>
                    <v-flex sm12 fill-height>
                        <v-card flat dark class="transparent">
                            <v-card-title primary-title>
                                <h3 class="subheading">
                                    <strong>{{ __('Theme:') }}</strong> {{ get_active_theme()->name }}
                                </h3>
                                <v-spacer></v-spacer>
                            </v-card-title>
                            <v-card-actions>
                                <v-chip label class="primary white--text"><v-icon left>format_paint</v-icon>{{ __('currently applied as the site theme') }}</v-chip>
                                <v-spacer></v-spacer>
                                <v-btn primary class="elevation-1" href="{{ route('themes.index') }}">{{ __('Change') }}</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-card-media>
        </v-card>
    </draggable>
@endviewable
