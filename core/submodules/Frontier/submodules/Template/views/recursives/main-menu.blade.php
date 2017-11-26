@foreach ($items as $menu)
    @if (isset($subtree) && $subtree)
        <v-list-tile :class="{'primary white--text': '{{ $menu->active }}'}" href="{{ $menu->url }}">
            <v-list-tile-content>
                <v-list-tile-title :class="{'white--text': '{{ $menu->active }}'}">
                    {{ $menu->title }}
                </v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    @elseif ($menu->children)
        <v-menu offset-y transition="slide-y-transition" bottom>
            <v-btn slot="activator" link flat :class="{'btn--active primary--text': '{{ $menu->active }}'}">
                <span>{{ $menu->title }}</span>
                <v-icon right>keyboard_arrow_down</v-icon>
            </v-btn>
            <v-list>
                @include("Template::recursives.main-menu", ['items' => $menu->children, 'subtree' => 1])
            </v-list>
        </v-menu>
    @else
        <v-btn :class="{'btn--active primary--text': '{{ $menu->active }}'}" link flat href="{{ $menu->url }}">
            <span>{{ $menu->title }}</span>
        </v-btn>
    @endif
@endforeach
