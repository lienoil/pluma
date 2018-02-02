@viewable(widgets('cpu-usage'))
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-card class="elevation-1 mb-3 draggable-widget">
            <v-toolbar card class="sortable-handle transparent">
                <v-icon left>{{ widgets('cpu-usage')->icon }}</v-icon>
                <v-toolbar-title class="body-2">{{ __(widgets('cpu-usage')->name) }}</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                {{--  --}}
            </v-card-text>
        </v-card>
    </draggable>
@endviewable
