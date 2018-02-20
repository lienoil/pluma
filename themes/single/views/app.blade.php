@include("Theme::partials.head")

@section("app")
  <div id="app" data-root-application>
    <v-app>

      <v-content>
        @stack("before-content")

        <v-slide-x-reverse-transition mode="out-in">
          <router-view></router-view>
        </v-slide-x-reverse-transition>

        <v-btn primary @click="localstorage('theme.dark', theme.dark = ! theme.dark)">{{ __('Toggle Dark Theme') }}</v-btn>
        {{-- <component :is="component"></component> --}}

        @stack("after-content")
      </v-content>

    </v-app>
  </div>
@show

@include("Theme::partials.foot")
