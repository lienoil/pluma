<v-card flat class="mb-3 transparent">
    <v-list class="transparent">

        {{-- {{ dd(navigations('sidebar')->parent->children) }} --}}
        @if (isset(navigations('sidebar')->parent->children))
            @foreach (navigations('parent')->children as $menu)
                <v-list-tile href="{{ $menu->url }}" title="{{ @$menu->labels->description }}">
                    <v-list-tile-action>
                        <v-icon :class="{'primary--text': '{{ $menu->active }}'}">{{ @$menu->icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title
                            :class="{'primary--text': '{{ $menu->active }}'}"
                            class="body-1">{{ @$menu->labels->title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            @endforeach
        @endif

    </v-list>
</v-card>
