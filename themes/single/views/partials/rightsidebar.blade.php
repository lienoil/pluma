<v-navigation-drawer
  temporary
  right
  v-model="rightsidebar.model"
  absolute
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
    <v-subheader><v-icon></v-icon>{{ __('Theme') }}</v-subheader>
    <v-card-text>
      <v-switch
        class="caption"
        :label="theme.dark ? `{{ __('Dark Theme') }}` : `{{ __('Light Theme') }}`"
        v-model="theme.dark"
        @change="localstorage('theme.dark', theme.dark)"
      ></v-switch>
    </v-card-text>

    <v-subheader><v-icon></v-icon>{{ __('Font Size') }}</v-subheader>
    <v-card-text>
      <v-slider
        :max="5"
        :min="-1"
        step="1"
        role="button"
        thumb-label
        v-model="settings.fontsize"
        @input="localstorage('settings.fontsize', settings.fontsize)"
      ></v-slider>
    </v-card-text>
  </v-card>
</v-navigation-drawer>
