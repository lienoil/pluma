@include("Theme::partials.head")

@section("app")
  <div id="app" data-root-application>
    <v-app>

      @stack("before-content")

      <v-content>

        @stack("before-inner-content")

        @section("main")
          @section("m-content")
            <v-slide-x-reverse-transition mode="out-in">
              <router-view :class="`content-size-${settings.fontsize}`"></router-view>
            </v-slide-x-reverse-transition>
          @show
        @show

        @stack("after-inner-content")

      </v-content>

      @stack("after-content")

      @stack("debugger")

    </v-app>
  </div>
@show

@include("Theme::partials.foot")
