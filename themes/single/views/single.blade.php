@include("Theme::partials.head")

@section("app")
  <div id="app" data-root-application v-cloak>
    <v-app>

      @stack("before-content")

      <v-content>

        @stack("before-inner-content")

        @section("main")
          <div :class="`content-size-${settings.fontsize}`">
            @section("main-content")
              <v-slide-x-reverse-transition mode="out-in">
                <router-view></router-view>
              </v-slide-x-reverse-transition>
            @show
          </div>
        @show

        @stack("after-inner-content")

      </v-content>

      @stack("after-content")

      @stack("debugger")

    </v-app>
  </div>
@show

@include("Theme::partials.foot")
