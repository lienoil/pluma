@include("Theme::partials.head")

@section("app")
  <div id="app" data-root-application>
    <v-app>

      @stack("before-content")

      <v-content>

        @stack("before-inner-content")

        <v-slide-x-reverse-transition mode="out-in">
          <router-view></router-view>
        </v-slide-x-reverse-transition>

        {{-- <component :is="component"></component> --}}

        @stack("after-inner-content")

      </v-content>

      @stack("after-content")

    </v-app>
  </div>
@show

@include("Theme::partials.foot")
