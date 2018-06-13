<v-toolbar
  :dark="theme.dark"
  app
  flat
  absolute
  scroll-off-screen
  transition="slide-y-transition"
  >
  <v-toolbar-side-icon @click="localstorage({'single.sidebar.model': (sidebar.model = !sidebar.model)})"></v-toolbar-side-icon>

  <v-text-field id="searchbar" v-shortkey="['/']" @shortkey.native="search().open($event)" flat solo  placeholder="Search" suffix="/"></v-text-field>
  <v-spacer></v-spacer>

  @if (request()->input('rightsidebar'))
    <v-avatar role="button" @click="rightsidebar.model = !rightsidebar.model" size="38px">
      <img src="{{ navigations('profile')->labels->avatar }}" alt="{{ navigations('profile')->labels->name }}">
    </v-avatar>
  @else

  <v-menu left>
    <v-avatar slot="activator" size="38px">
      <img src="{{ navigations('profile')->labels->avatar }}" alt="{{ navigations('profile')->labels->name }}">
    </v-avatar>
    <v-card>
      <v-list two-line>
        <v-list-tile>
          <v-list-tile-action>
            <v-avatar size="42px">
              <img src="{{ navigations('profile')->labels->avatar }}" alt="{{ navigations('profile')->labels->name }}">
            </v-avatar>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ navigations('profile')->labels->name }}</v-list-tile-title>
            <v-list-tile-sub-title>{{ navigations('profile')->labels->role }}</v-list-tile-sub-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-list dense>
        @foreach (navigations('profile')->children as $menu)
          @if (isset($menu->is_divider))
            <v-divider></v-divider>
          @else
            <v-list-tile href="{{ $menu->slug }}">
              <v-list-tile-action>
                <v-icon>{{ $menu->icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ $menu->labels->title }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          @endif
        @endforeach
      </v-list>
    </v-card>
  </v-menu>
  <v-btn icon ripple @click="rightsidebar.model = !rightsidebar.model"><v-icon color="grey">keyboard_arrow_left</v-icon></v-btn>
  @endif


</v-toolbar>
