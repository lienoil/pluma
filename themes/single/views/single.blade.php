@include("Theme::partials.head")

@section("app")
  <div id="app" data-root-application>
    <v-app>

      @stack("before-content")

      <v-content>

        @stack("before-inner-content")

        <v-slide-x-reverse-transition mode="out-in">
          {{-- <component is="Breadcrumbs" keep-alive></component> --}}
          <router-view></router-view>
        </v-slide-x-reverse-transition>

        <v-btn primary @click="localstorage('theme.dark', theme.dark = ! theme.dark)">{{ __('Toggle Dark Theme') }}</v-btn>

        @stack("after-inner-content")

      </v-content>

      @stack("after-content")

    </v-app>
  </div>
@show

@include("Theme::partials.foot")
