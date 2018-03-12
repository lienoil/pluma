@extends("Theme::app")

@push("before-content")
  @include("Theme::partials.sidebar")
  @include("Theme::partials.utilitybar")
@endpush

@push("before-inner-content")
  @include("Theme::partials.breadcrumbs")

  {{-- @if (config('debugging.debug'))
    <v-btn color="success" @click="snackbar.color='secondary';snackbar.type='success';snackbar.theme='dark';snackbar.text='The Succession successfully succeeded!'; snackbar.model = !snackbar.model">Snackbar Success Test</v-btn>
    <v-btn color="warning" @click="snackbar.type='warning';snackbar.theme='dark';snackbar.text='Oops! Looks like something went wrong'; snackbar.model = !snackbar.model">Snackbar Warning Test</v-btn>
    <v-btn color="error" @click="snackbar.type='error';snackbar.theme='dark';snackbar.text='An error occurred!'; snackbar.model = !snackbar.model;snackbar.color='secondary'">Snackbar Error Test</v-btn>
    <v-btn color="info" @click="dialog.type='prompt';dialog.theme='dark';dialog.text='A prompt occurred!'; dialog.model = !dialog.model;dialog.color='secondary'">Dialog Question Test</v-btn>
    <v-dialog v-model="dialog.model" width="auto">
      <v-card flat :dark="theme.dark" :light="!theme.dark">
        <alert-icon medium mode="prompt"></alert-icon>
        <v-card-text class="grey--text">
          <p class="headline">Are you sure you want to reset the Application UI?</p>
          <p class="subheading">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
          <p class="error--text">This is your last warning.</p>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color=default @click="dialog.model = false">No</v-btn>
          <v-dialog ref="success-dialog">
            <v-btn slot=activator color=primary @click="dialog.model = false">Yes</v-btn>
            <v-card flat :dark="theme.dark" :light="!theme.dark">
              <alert-icon medium mode="success"></alert-icon>
              <v-card-text class="text-xs-center">
                <p class="headline">Success on whatever that action was!</p>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color=primary @click="$refs['success-dialog'].close()">Okay</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-card-actions>
      </v-card>
    </v-dialog>
  @endif --}}
@endpush

@push("after-inner-content")
  @include("Theme::partials.rightsidebar")
@endpush

@push("after-content")
  @include("Theme::partials.flash")
  @include("Theme::partials.footer")
@endpush
