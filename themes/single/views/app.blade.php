@include("Theme::partials.head")

@section("app")
  <div id=app data-root-application>
    <v-app>

      @stack("before-content")

      <v-content>

        @stack("before-inner-content")

        <v-slide-x-reverse-transition mode="out-in">
          <router-view :class="`font-size-${settings.fontsize}`"></router-view>
        </v-slide-x-reverse-transition>

        @stack("after-inner-content")

        @if (config('debugging.debug'))
          {{-- <v-card dark>
            <alert-icon small></alert-icon>
            <alert-icon mode="warning"></alert-icon>
          </v-card> --}}
          <v-btn color="success" @click="snackbar.color='secondary';snackbar.type='success';snackbar.theme='dark';snackbar.text='The Succession successfully succeeded!'; snackbar.model = !snackbar.model">Snackbar Success Test</v-btn>
          <v-btn color="warning" @click="snackbar.type='warning';snackbar.theme='dark';snackbar.text='Oops! Looks like something went wrong'; snackbar.model = !snackbar.model">Snackbar Warning Test</v-btn>
          <v-btn color="error" @click="snackbar.type='error';snackbar.theme='dark';snackbar.text='An error occurred!'; snackbar.model = !snackbar.model;snackbar.color='secondary'">Snackbar Error Test</v-btn>
        @endif

      </v-content>

      @stack("after-content")

      @stack("debugger")

    </v-app>
  </div>
@show

@include("Theme::partials.foot")
