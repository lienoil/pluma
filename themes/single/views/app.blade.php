@include("Theme::partials.head")

@section("app")
  <div id="app" data-root-application>
    <v-app>

      @stack("before-content")

      <v-content>
        <component :is="component"></component>
      </v-content>

      @stack("after-content")

    </v-app>
  </div>
@endsection

@include("Theme::partials.foot")
