<v-list-tile>
    @if (isset($menu->icon))
        <v-list-tile-action>
            <v-icon :dark.sync="dark" :light.sync="light">{{ $menu->icon }}</v-icon>
        </v-list-tile-action>
    @endif

    <v-list-tile-content>
        <v-list-tile-title {{ isset($menu->has_children) && ! $menu->has_children ? 'slot="item"' : '' }}>
            @if (isset($menu->has_children) && $menu->has_children)
                {{ $menu->labels->title }}
            @else
                <span role="button" href="{{ $menu->slug or '' }}">{{ isset($menu->labels) ? $menu->labels->title : '' }}</span>
            @endif
        </v-list-tile-title>
    </v-list-tile-content>

    @if (isset($menu->has_children) && $menu->has_children)
        <v-list-tile-action>
            <v-icon :dark.sync="dark" :light.sync="light">keyboard_arrow_down</v-icon>
        </v-list-tile-action>
    @endif

</v-list-tile>

<!-- if -->
@if (isset($menu->has_children) && $menu->has_children)

    @foreach ($menu->children as $child)
        @include("Frontier::templates.navigations.nav-item", ['menu' => collect($child->children), 'depth' => ++$depth])
    @endforeach
@endif
