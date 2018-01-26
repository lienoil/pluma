@viewable(widgets('system-corner'))
    <v-card dark class="elevation-1 mb-3 grey darken-4">
        <v-toolbar dark card class="transparent">
            <v-icon dark>{{ widgets('system-corner')->icon }}</v-icon>
            <v-toolbar-title class="body-2">{{ widgets('system-corner')->name }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="grey darken-3">
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
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat dark href="{{ route('settings.system') }}">{{ __('View More') }}</v-btn>
        </v-card-actions>
    </v-card>
@endviewable
