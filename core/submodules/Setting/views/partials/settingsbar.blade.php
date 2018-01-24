<v-card flat class="mb-3 transparent">
    <v-list class="transparent">

        @php
            echo "<pre>";
                var_dump( $navigation->sidebar->current->children ); die();
            echo "</pre>";
        @endphp

        @foreach (menus($navigation->sidebar->flat, route('settings.branding')) as $menu)
            {{-- expr --}}
        @endforeach

        <v-list-tile href="{{ route('settings.branding') }}">
            <v-list-tile-action>
                <v-icon :class="{'primary--text': '{{ route('settings.branding') === $active }}'}">fa-leaf</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title :class="{'primary--text': '{{ route('settings.branding') === $active }}'}" class="body-1">{{ __('Branding') }}</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-tile href="{{ route('settings.social') }}">
            <v-list-tile-action>
                <v-icon :class="{'primary--text': '{{ route('settings.social') === $active }}'}">fa-facebook</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title :class="{'primary--text': '{{ route('settings.social') === $active }}'}" class="body-1" class="body-1">{{ __('Social Media') }}</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

    </v-list>
</v-card>
