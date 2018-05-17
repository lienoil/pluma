<v-toolbar dark>
  <a href="{{ home() }}">
    <v-avatar size="45px">
      <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}">
    </v-avatar>
  </a>
  <v-toolbar-title>
    <h1 class="subheading">{{ $application->site->title }}</h1>
    <div class="caption">{{ $application->site->tagline }}</div>
  </v-toolbar-title>

  <v-spacer></v-spacer>

  <v-toolbar-items>
    @include("Template::recursives.main-menu", ['items' => get_navmenus('main-menu')])

    @if (settings('show_login_button_in_main_menu', true))
      @if (user())
        <v-btn flat color="secondary" href="{{ route('login.show') }}">{{ __('Dashboard') }}</v-btn>
      @else
        <v-btn flat href="{{ route('login.show') }}">{{ __('Login') }}</v-btn>
      @endif
    @endif
  </v-toolbar-items>
</v-toolbar>
