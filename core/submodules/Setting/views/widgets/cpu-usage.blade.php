@viewable(widgets('cpu-usage'))
    <v-card class="elevation-1 mb-3">
        <v-toolbar card class="transparent">
            <v-icon left>{{ widgets('cpu-usage')->icon }}</v-icon>
            <v-toolbar-title class="body-2">{{ __(widgets('cpu-usage')->name) }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            {{--  --}}
        </v-card-text>
    </v-card>
@endviewable
