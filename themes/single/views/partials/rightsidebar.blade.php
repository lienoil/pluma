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

    <v-subheader>{{ __('Sidebar') }}</v-subheader>
    <v-subheader class="caption">{{ __('Background') }}</v-subheader>
    <v-container grid-list-lg>
      <v-layout row wrap>
        <v-flex xs4>
          <v-card ripple height="100%" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url(https://vuejs.creative-tim.com/vue-light-bootstrap-dashboard/static/img/sidebar-5.jpg)'">
            <img src="https://vuejs.creative-tim.com/vue-light-bootstrap-dashboard/static/img/sidebar-5.jpg" width="100%" height="auto">
          </v-card>
        </v-flex>

        <v-flex xs4>
          <v-card ripple height="100%" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/double-exposure-effect.jpg') }})'">
            <img src="{{ theme('static/img/placeholders/double-exposure-effect.jpg') }}" width="100%" height="auto">
          </v-card>
        </v-flex>

        <v-flex xs4>
          <v-card ripple height="100%" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url({{ theme('static/img/placeholders/foxy-lady.jpg') }})'">
            <img src="{{ theme('static/img/placeholders/foxy-lady.jpg') }}" width="auto" height="100px">
          </v-card>
        </v-flex>

        <v-flex xs4>
          <v-card ripple height="100%" role="button" @click.native="sidebar.withBackground=true;sidebar.style.background = 'url(https://source.unsplash.com/800x2000?nature)'">
            <img src="https://source.unsplash.com/800x2000?nature" width="100%" height="auto">
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
    <v-subheader class="caption">{{ __('Color') }}</v-subheader>
    <v-card flat>
      <v-card-media height="20px" :style="{ background: `rgb(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b})` }"></v-card-media>
      <v-card-text>
        <v-slider hide-details @input="sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`" label="R" :max="255" v-model="sidebar.style.rgba.r"></v-slider>
        <v-slider hide-details @input="sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`" label="G" :max="255" v-model="sidebar.style.rgba.g"></v-slider>
        <v-slider hide-details @input="sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`" label="B" :max="255" v-model="sidebar.style.rgba.b"></v-slider>
        <v-slider hide-details @input="sidebar.style.color = `rgba(${sidebar.style.rgba.r}, ${sidebar.style.rgba.g}, ${sidebar.style.rgba.b}, ${sidebar.style.rgba.a}%)`" label="A" :max="100" v-model="sidebar.style.rgba.a"></v-slider>
      </v-card-text>
    </v-card>
  </v-card>
</v-navigation-drawer>
