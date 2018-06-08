@include("Theme::partials.head")

@section("app")
  <div id="app" data-root-application v-cloak>
    <v-app :dark="theme.dark">

      @stack("before-content")

      <v-content>

        @stack("before-inner-content")

        @section("main")
          <div :class="`content-size-${settings.fontsize}`" class="mb-5">
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
