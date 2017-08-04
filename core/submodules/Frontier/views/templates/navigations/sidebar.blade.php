@foreach ($menus as $menu)

    @if (isset($menu->is_header) && $menu->is_header)
        <v-layout
            row
            align-center
        >
            <v-flex xs6>
                <v-subheader>{{ isset($menu->text) ? $menu->text : '' }}</v-subheader>
            </v-flex>
        </v-layout>

    @else

        @if ($menu->has_children)
            <v-list-group v-model="navigation">
                <v-list-tile slot="item" class="{{ $menu->active ? 'list--group__header--active' : '' }}">
                    @if (isset($menu->icon))
                        <v-list-tile-action>
                            <v-icon :dark.sync="dark" :light.sync="light">{{ $menu->icon }}</v-icon>
                        </v-list-tile-action>
                    @endif

                    <v-list-tile-content>
                        <v-list-tile-title>
                            @if (isset($menu->has_children) && $menu->has_children)
                                {{ $menu->labels->title }}
                            @else
                                <a role="button" href="{{ $menu->slug }}">{{ isset($menu->labels) ? $menu->labels->title : '' }}</a>
                            @endif
                        </v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <v-icon @click="() => {menu.open = !menu.open}">@{{ menu.open ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                    </v-list-tile-action>
                </v-list-tile>

                @foreach ($menu->children as $menu)
                    <v-list-tile href="{{ $menu->slug }}" class="{{ $menu->active ? 'primary' : '' }}">
                        @if (isset($menu->icon))
                            <v-icon :dark.sync="dark" :light.sync="light">{{ $menu->icon }}</v-icon>
                        @endif
                        {{ $menu->labels->title }}
                    </v-list-tile>
                @endforeach

            </v-list-group>

        @else

            <v-list-tile href="{{ $menu->slug }}" class="{{ $menu->active ? 'primary' : '' }}">
                @if (isset($menu->icon))
                    <v-list-tile-action>
                        <v-icon :dark.sync="dark" :light.sync="light">{{ $menu->icon }}</v-icon>
                    </v-list-tile-action>
                @endif

                <v-list-tile-content>
                    <v-list-tile-title {{ isset($menu->has_children) && ! $menu->has_children ? 'slot="item"' : '' }}>
                        {{ $menu->labels->title }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

        @endif

    @endif

@endforeach

@push('post-css')
    <style>
        .application .navigation-drawer a {
            text-decoration: none !important;
        }
    </style>
@endpush
