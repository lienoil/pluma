@foreach ($menus as $menu)
    @if ($menu->children)
        <v-menu offset-y transition="slide-y-transition" bottom>
            <v-btn slot="activator" link flat>
                <span>{{ $menu->title }}</span>
                <v-icon right>keyboard_arrow_down</v-icon>
            </v-btn>
            <v-list>
                @include("Template::recursives.main-menu", ['menus' => $menu->children, 'subtree' => 1])
            </v-list>
        </v-menu>
    @elseif (isset($subtree) && $subtree)
        <v-list-tile href="{{ $menu->slug }}">
            <v-list-tile-content>
                <v-list-tile-title>{{ $menu->title }}</v-list-tile-title>
                {{-- <v-list-tile-sub-title>{{ $menu->excerpt }}</v-list-tile-sub-title> --}}
            </v-list-tile-content>
        </v-list-tile>
    @else
        <v-btn :class="{'btn--active primary--text': '{{ $menu->active }}'}" link flat href="{{ url($menu->slug) }}">
            <span>{{ $menu->title }}</span>
        </v-btn>
    @endif
@endforeach
