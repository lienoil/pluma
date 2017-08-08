@if (Session::has("type"))
    <v-alert
        {{-- :hide-icon="true" --}}
        icon="{{ Session::has("type") == 'success' ? 'check' : 'priority_high' }}"
        class="{{ Session::get("type") }} mb-4"
        dismissible
        transition="slide-y-transition"
        v-model="alert.model"
        value="{{ Session::has("type") ? true : false }}"
    >
        <v-card style="margin-bottom: -2rem" class="elevation-1 mb--2">
            @if (Session::has('title'))
                <v-card-title class="headline">{{ __(Session::get('title')) }}</v-card-title>
            @endif
            @if (Session::has('message'))
                <v-card-text class="text-xs-center">{{ __(Session::get('message')) }}</v-card-text>
            @endif
        </v-card>
    </v-alert>
@endif
