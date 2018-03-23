<v-navigation-drawer
  temporary
  right
  v-model="rightsidebar.model"
  fixed
  :dark="theme.dark"
>
  <v-toolbar card class="transparent">
    <v-icon left>flash_on</v-icon>
    <v-toolbar-title class="body-2 grey--text">{{ __('Quick Settings') }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn icon ripple @click="rightsidebar.model = false"><v-icon color="grey">keyboard_arrow_right</v-icon></v-btn>
  </v-toolbar>
  <v-divider></v-divider>
  <v-card flat class="transparent">
    <v-subheader>{{ __('Theme') }}</v-subheader>
    <v-card-text>
      <v-switch
        class="caption"
        :label="theme.dark ? `{{ __('Dark Theme') }}` : `{{ __('Light Theme') }}`"
        v-model="theme.dark"
        @change="localstorage('single.theme.dark', theme.dark)"
      ></v-switch>
    </v-card-text>

    <v-subheader>{{ __('Font Size') }}</v-subheader>
    <v-card-text>
      <v-slider
        :max="40"
        :min="-1"
        @input="localstorage('single.settings.fontsize', settings.fontsize)"
        :prepend-icon="settings.fontsize === 1 ? 'font_download' : 'refresh'"
        :prepend-icon-cb="() => { localstorage('single.settings.fontsize', (settings.fontsize=1)) }"
        role="button"
        step="1"
        thumb-label
        v-model="settings.fontsize"
      ></v-slider>
    </v-card-text>

    <v-btn @click="sidebar.withBackground=true;sidebar.style.background = 'url(https://vuejs.creative-tim.com/vue-light-bootstrap-dashboard/static/img/sidebar-5.jpg)'">Change BG</v-btn>

    <v-btn @click="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/foxy-lady.jpg') }})'">Fox</v-btn>
    <v-btn @click="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/double-exposure-effect.jpg') }})'">Forest</v-btn>
  </v-card>
</v-navigation-drawer>
