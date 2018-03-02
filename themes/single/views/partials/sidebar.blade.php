<v-navigation-drawer
  :dark.sync="theme.dark"
  :floating="sidebar.floating"
  :light.sync="! theme.dark"
  :mini-variant.sync="sidebar.mini"
  :clipped="sidebar.clipped"
  app
  v-model="sidebar.model"
  @click.native.stop="localstorage('single.sidebar.mini', sidebar.mini)"
>
  <v-toolbar flat class="transparent">
    <v-list>
      <v-list-tile avatar>
        <v-list-tile-avatar>
          <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}">
        </v-list-tile-avatar>
        <v-list-tile-content>
          <v-list-tile-title><strong>{{ $application->site->title }}</strong></v-list-tile-title>
          <v-list-tile-sub-title class="caption">{{ $application->site->tagline }}</v-list-tile-sub-title>
        </v-list-tile-content>
        <v-list-tile-action>
          <v-btn ripple icon :dark.sync="theme.dark" :light.sync="! theme.dark" @click="localstorage('single.sidebar.mini', sidebar.mini = ! sidebar.mini)">
            <v-icon :dark.sync="theme.dark" :light.sync="! theme.dark" class="grey--text lighten-2">chevron_left</v-icon>
          </v-btn>
        </v-list-tile-action>
      </v-list-tile>
    </v-list>
  </v-toolbar>

  <v-divider></v-divider>

  <v-list>
    @foreach (navigations('sidebar') as $name => $menu)

      {{-- Avatar --}}
      @if (isset($menu->is_avatar) && $menu->is_avatar)
        <v-list-group
          :dark.sync="theme.dark" :light.sync="! theme.dark"
          class="mb-4"
          no-action
        >
          <v-list-tile ripple avatar slot="activator">
            <v-list-tile-avatar>
              <img src="{{ $menu->labels->avatar }}">
            </v-list-tile-avatar>
            <v-list-tile-content>
              <v-list-tile-title>{{ $menu->labels->name }}</v-list-tile-title>
              <v-list-tile-sub-title class="caption">
                <v-icon :dark.sync="theme.dark" :light.sync="! theme.dark">supervisor_account</v-icon>
                <span>{{ $menu->labels->role }}</span>
              </v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>

          @foreach ($menu->children as $submenu)
            @isset($submenu->is_divider)
              <v-divider></v-divider>
            @else
              {{-- {{ isset($submenu->routename) ? ":to={name: '$submenu->routename'}" : "href=$submenu->url" }} --}}
              <v-list-tile ripple exact @click="navigate('components/Pluma/Page/Show')">
                @isset ($submenu->icon)
                  <v-list-tile-avatar>
                    <v-icon>{{ $submenu->icon }}</v-icon>
                  </v-list-tile-avatar>
                @endisset
                @isset ($submenu->labels->title)
                  <v-list-tile-content>
                    <v-list-tile-title>{{ $submenu->labels->title }}</v-list-tile-title>
                  </v-list-tile-content>
                @endisset
              </v-list-tile>
            @endisset
          @endforeach
        </v-list-group>

      {{-- Header --}}
      @elseif (isset($menu->is_header) && $menu->is_header)
        <v-subheader :dark.sync="theme.dark" :light.sync="! theme.dark">
          <small>{{ strtoupper($menu->text) }}</small>
          &nbsp;<v-divider :dark.sync="theme.dark" :light.sync="! theme.dark"></v-divider>
        </v-subheader>

      {{-- Has Children --}}
      @elseif (isset($menu->has_children) && $menu->has_children)
        <v-list-group ripple no-action prepend-icon="{{ $menu->icon ?? 'widgets' }}">
          <v-list-tile ripple slot="activator">
            <v-list-tile-content>
              <v-list-tile-title>{{ @$menu->labels->title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          @foreach ($menu->children as $submenu)
            @isset($submenu->is_divider)
              <v-divider></v-divider>
            @else
              <v-list-tile ripple exact :to="{name: '{{ $submenu->routename ?? 'index' }}'}">
                {{-- @isset($submenu->icon)
                  <v-list-tile-action>
                    <v-icon>{{ $submenu->icon }}</v-icon>
                  </v-list-tile-action>
                @endisset --}}
                @isset ($submenu->labels->title)
                  <v-list-tile-content>
                    <v-list-tile-title>{{ $submenu->labels->title }}</v-list-tile-title>
                  </v-list-tile-content>
                @endisset
              </v-list-tile>
            @endisset
          @endforeach
        </v-list-group>

      {{-- No Child --}}
      @else
        <v-list-tile ripple exact {{ isset($menu->routename) ? ":to={name: '$menu->routename'}" : "href=$menu->url" }}>
          @isset ($menu->icon)
            <v-list-tile-avatar>
              <v-icon>{{ $menu->icon }}</v-icon>
            </v-list-tile-avatar>
          @endisset
          @isset ($menu->labels->title)
            <v-list-tile-content>
              <v-list-tile-title>{{ $menu->labels->title }}</v-list-tile-title>
            </v-list-tile-content>
          @endisset
        </v-list-tile>
      @endif

    @endforeach
  </v-list>
</v-navigation-drawer>
