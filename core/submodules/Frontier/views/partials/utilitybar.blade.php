@yield("pre-utilitybar")
<v-toolbar
    :class="theme.utilitybar"
    class="elevation-1 grey--text"
    fixed
    :dark.sync="light" :light.sync="dark"
>
    <v-toolbar-side-icon class="grey--text" @click.native.stop="setStorage('sidebar.drawer', (sidebar.drawer = !sidebar.drawer))">
        <v-icon :dark.sync="dark" :light.sync="light">@{{ sidebar.drawer?'chevron_right':'chevron_left' }}</v-icon>
    </v-toolbar-side-icon>
    <v-toolbar-title>@section("page-title"){{ __($application->page->title) }}@show</v-toolbar-title>

    <v-spacer></v-spacer>

    @stack("utilitybar")

    @section("utilitybar-menu")
        <v-list-tile-avatar>
            <img src="{{ user()->avatar }}" alt="{{ user()->handlename }}">
        </v-list-tile-avatar>
        <v-list-tile-content>
            <v-menu offset-y origin="bottom right" min-width="180px">
                <v-list-tile-title slot="activator" flat :dark.sync="dark" :light.sync="light">
                    {{ $application->greet or __("Hello, ") . user()->displayname }}
                </v-list-tile-title>
                <v-list>
                    {{-- route('setting.profile') --}}
                    <v-list-tile href="{{ '#' }}">
                        <v-list-tile-action>
                            <v-icon>account_circle</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-title>{{ __('Profile') }}</v-list-tile-title>
                    </v-list-tile>

                    <v-divider></v-divider>
                    <v-list-tile href="{{ route('logout.logout') }}">
                        <v-list-tile-action>
                            <v-icon>backspace</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-title>{{ __('Logout') }}</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-list-tile-content>
    @show

    <v-btn icon class="grey--text" @click.native.stop="rightsidebar.model = !rightsidebar.model">
        <v-icon :dark.sync="dark" :light.sync="light">chevron_left</v-icon>
    </v-btn icon>
</v-toolbar>
@yield("post-utilitybar")
